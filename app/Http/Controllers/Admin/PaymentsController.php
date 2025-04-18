<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\order;
use App\Models\payments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentsController extends Controller
{

    public function index()
    {
        // جلب الطلبات التي تم دفعها فقط
        $orders = order::with('user')
            ->where('status', 'paid')
            ->latest('id')
            ->paginate(10);

        return view('admin.payments.index', compact('orders'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:user,id',
            'total_price' => 'required|numeric',
        ]);

        $payment = payments::create([
            'user_id' => $request->user_id,
            'total_price' => $request->total_price,
        ]);

        return redirect()
            ->route('admin.payments.index')
            ->with('msg', 'payment added successfully')
            ->with('type', 'success');
    }

    public function edit(payments $payment)
    {
        $user = User::select('id', 'name')->get();
        return view('admin.payments.edit', compact('payment', 'user'));
    }

    public function show($id)
    {
        $order = order::with(['user', 'order_details.product'])->findOrFail($id);
        return view('admin.payments.show', compact('order'));
    }


    public function update(Request $request, payments $payment)
    {
        $request->validate([
            'user_id' => 'required|exists:user,id',
            'total_price' => 'required|numeric',
        ]);

        $payment->update([
            'user_id' => $request->user_id,
            'total_price' => $request->total_price,
        ]);

        return redirect()
            ->route('admin.payments.index')
            ->with('msg', 'payment updated successfully')
            ->with('type', 'success');
    }

    public function destroy(payments $payment)
    {
        // حذف جميع تفاصيل الطلب المرتبطة
        $payment->order_details()->delete();

        // حذف بيانات الدفع إن وجدت
        if ($payment->payment) {
            $payment->payment()->delete();
        }

        $payment->delete();

        return redirect()
            ->route('admin.payments.index')
            ->with('msg', 'payment deleted successfully')
            ->with('type', 'info');
    }







}
