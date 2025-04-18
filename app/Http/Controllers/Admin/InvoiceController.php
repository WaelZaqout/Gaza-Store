<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Image;
use App\Models\order;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Jobs\SendInvoiceEmailJob;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::latest('id')->paginate(10);
        return view('admin.invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $order = Order::find($request->order_id);
        if (!$order) {
            return redirect()->route('admin.orders.index')->with('error', 'الطلب غير موجود');
        }

        return view('admin.invoices.create', compact('order'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'invoice_number' => 'required|unique:invoices',
            'order_id' => 'required',
            'user_id' => 'required',
            'invoice_date' => 'required|date_format:Y-m-d',
            'due_date' => 'required|date_format:Y-m-d',
            'amount_collection' => 'required|numeric',
            'amount_commission' => 'required|numeric',
            'discount' => 'required|numeric',
            'rate_vat' => 'required|numeric',
            'status' => 'required|in:paid,pending ',
            'note' => 'nullable',
            'image' => 'nullable|mimes:pdf,jpeg,jpg,png',
        ]);

        // تحويل التواريخ إلى تنسيق MySQL الصحيح (إذا لزم الأمر)
        $invoice_date = date('Y-m-d', strtotime($request->invoice_date));
        $due_date = date('Y-m-d', strtotime($request->due_date));

        // حساب القيمة المضافة
        $amount_after_discount = $request->amount_collection - $request->discount;
        $value_vat = ($amount_after_discount * $request->rate_vat) / 100;
        $total = $amount_after_discount + $value_vat;

        $value_status = match ($request->status) {
            'paid' => 1,
            'pending' => 2,

            default => 2,
        };

        // إنشاء الفاتورة
        $invoice = Invoice::create([
            'invoice_number' => $request->invoice_number,
            'order_id' => $request->order_id,
            'user_id' =>(int) $request->user_id, // تحويل النص إلى عدد صح
            'invoice_date' => $invoice_date,
            'due_date' => $due_date,
            'amount_collection' => $request->amount_collection,
            'amount_commission' => $request->amount_commission,
            'discount' => $request->discount,
            'rate_vat' => $request->rate_vat,
            'value_vat' => $value_vat,
            'total' => $total,
            'status' => $request->status,
            'value_status' => $value_status,
            'note' => $request->note,
        ]);

        // حفظ الصورة إن وجدت
        if ($request->hasFile('image')) {
            $img_name = rand() . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images'), $img_name);

            $invoice->image()->create([
                'path' => $img_name,
            ]);
        }
        // توليد ملف PDF
        $pdf = Pdf::loadView('emails.invoice_pdf', compact('invoice'));

        // إرسال الإيميل مع المرفق
        Mail::send([], [], function ($message) use ($invoice, $pdf) {
            $message->to($invoice->user->email)
                ->subject('🧾 فاتورتك من Gaza Store')
                ->attachData($pdf->output(), "invoice_{$invoice->invoice_number}.pdf");
        });
        return redirect()->route('admin.invoices.index')
            ->with('msg', 'تمت إضافة الفاتورة بنجاح')
            ->with('type', 'success');


    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice = Invoice::with('customer')->findOrFail($id);
        return view('admin.invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $categories = Category::select('id', 'name')->get();  // Changed to Service
        return view('admin.invoices.edit', compact('invoice', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'service_id' => 'required',
            'amount_collection' => 'required',
            'amount_commission' => 'required',
            'discount' => 'required',
            'rate_vat' => 'required',
            'status' => 'required|in:paid,pending ',
            'note' => 'nullable',
            'image' => 'nullable|mimes:pdf,jpeg,jpg,png',
        ]);

        $invoice->update([
            'category_id' => $request->category_id,
            'amount_collection' => $request->amount_collection,
            'amount_commission' => $request->amount_commission,
            'discount' => $request->discount,
            'rate_vat' => $request->rate_vat,
            'status' => $request->status,

            'notes' => $request->notes,
        ]);

        if ($request->hasFile('image')) {
            if ($invoice->image) {
                File::delete(public_path('images/' . $invoice->image->path));
            }
            $invoice->image()->delete();

            $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $img_name);

            $invoice->image()->create([
                'path' => $img_name,
            ]);
        }

        return redirect()->route('admin.invoices.index')
            ->with('msg', 'Invoice updated successfully')
            ->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        File::delete(public_path('images/' . $invoice->image->path));
        $invoice->image()->delete();
        $invoice->delete();

        return redirect()->route('admin.invoices.index')
            ->with('msg', 'Invoice deleted successfully')
            ->with('type', 'danger');
    }

    /**
     * Remove image from invoice.
     */

        function delete_img($id){
            $img =Image::find($id);
            File::delete(public_path( 'images/' .$img->path));

            return Image::destroy($id);
        }

        public function invoice_details($id)
        {
            $invoice = Invoice::with(['order.order_details.product', 'user'])->findOrFail($id);
            return view('admin.invoices.details', compact('invoice'));
        }


        public function getOrders($user_id)
        {
            $orders = Order::where('user_id', $user_id)->get(['id']);
            return response()->json($orders);

        }

        public function getPaymentStatus($order_id)
        {
            $order = Order::find($order_id);
            return response()->json(['payment_status' => $order ? $order->payment_status : 'غير متوفر']);
        }
        public function printInvoice($id)
        {
            $invoice = Invoice::findOrFail($id);

            $pdf = Pdf::loadView('admin.invoices.invoice_pdf', compact('invoice'));

            return $pdf->stream('invoice_' . $invoice->invoice_number . '.pdf');
// return $pdf->download('invoice_' . $invoice->invoice_number . '.pdf');

        }

        public function sendInvoiceEmail($id)
        {
            $invoice = Invoice::with('user')->findOrFail($id);

            if (!$invoice->user || !$invoice->user->email) {
                return redirect()->back()->with('error', 'المستخدم لا يملك بريدًا إلكترونيًا.');
            }

            // توليد PDF
            $pdf = Pdf::loadView('emails.invoice_pdf', compact('invoice'));

            // إرسال الإيميل
            Mail::send([], [], function ($message) use ($invoice, $pdf) {
                $message->to($invoice->user->email)
                        ->subject('🧾 فاتورتك من Gaza Store')
                        ->attachData($pdf->output(), "invoice_{$invoice->invoice_number}.pdf");
            });

            return redirect()->back()->with('success', '📩 تم إرسال الفاتورة بنجاح إلى العميل.');
        }
}
