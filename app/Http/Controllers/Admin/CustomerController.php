<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * عرض جميع العملاء
     */
    public function index()
    {
        $customers = Customer::latest()->paginate(10);
        $users = User::all();
        return view('admin.customers.index', compact('customers','users'));
    }

    /**
     * عرض نموذج إضافة عميل جديد
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * تخزين بيانات العميل الجديد
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|numeric|digits_between:8,15',
            'password' => 'required|min:6|confirmed',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.customers.index')->with('msg', 'Customer added successfully')->with('type', 'success');
    }

    /**
     * عرض بيانات عميل معين
     */
    public function show($id)
    {
        $customer = User::findOrFail($id); // البحث عن العميل أو إظهار خطأ 404 إذا لم يكن موجودًا
        return view('admin.customers.show', compact('customer'));
    }

    /**
     * عرض نموذج تعديل بيانات العميل
     */
    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    /**
     * تحديث بيانات العميل
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'required|numeric|digits_between:8,15',
            'password' => 'nullable|min:6|confirmed',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password ? Hash::make($request->password) : $customer->password,
            'address' => $request->address,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.customers.index')->with('msg', 'Customer updated successfully')->with('type', 'info');
    }

    /**
     * حذف العميل
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('admin.customers.index')->with('msg', 'Customer deleted successfully')->with('type', 'danger');
    }


}
