<?php

namespace App\Http\Controllers\Admin;

use App\Models\order;
use App\Models\OrderDetails;
use App\Models\Payments;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class OrderController extends Controller
{
    public function index()
    {
        $orders = order::with('user', 'payment')->latest('id')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:user,id',
            'total_price' => 'required|numeric',
        ]);

        $order = order::create([
            'user_id' => $request->user_id,
            'total_price' => $request->total_price,
        ]);

        return redirect()
            ->route('admin.orders.index')
            ->with('msg', 'order added successfully')
            ->with('type', 'success');
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,canceled',
        ]);

        $order->status = $request->status;

        if ($request->status === 'paid') {
            $order->updated_at = now(); // تحديث وقت الدفع
        }

        $order->save();

        return redirect()
            ->route('admin.orders.index')
            ->with('msg', 'تم تحديث حالة الدفع بنجاح')
            ->with('type', 'success');
    }

    public function destroy(order $order)
    {
        // حذف جميع تفاصيل الطلب المرتبطة
        $order->order_details()->delete();

        // حذف بيانات الدفع إن وجدت
        if ($order->payment) {
            $order->payment()->delete();
        }

        $order->delete();

        return redirect()
            ->route('admin.orders.index')
            ->with('msg', 'order deleted successfully')
            ->with('type', 'info');
    }

    public function showOrders()
    {
        $orders = order::with('user', 'order_details.product', 'payment')->get();
        return view('admin.orders.index', compact('orders'));
    }



    public function order_details($id)
    {
        $order = order::with('order_details.product', 'user', 'payment')->findOrFail($id);
        return view('admin.orders.details', compact('order'));
    }




}
