<?php

namespace App\Http\Controllers;

use App\Models\TypeCustomer;
use Illuminate\Http\Request;

class TypeCustomerController extends Controller
{
    public function index()
    {
        $typeCustomers = TypeCustomer::all();
        return view('admin.type_customers.index', compact('typeCustomers'));
    }

    public function create()
    {
        return view('admin.type_customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'Total_Deposit' => 'required|numeric|min:0',
            'Discount_percent' => 'required|numeric|min:0|max:100',
            'status' => 'required|in:active,inactive',
        ]);

        TypeCustomer::create($request->all());

        return redirect()->route('type_customers.index')->with('success', 'Loại khách hàng đã được thêm thành công.');
    }

    public function edit(TypeCustomer $typeCustomer)
    {
        return view('admin.type_customers.edit', compact('typeCustomer'));
    }

    public function update(Request $request, TypeCustomer $typeCustomer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'Total_Deposit' => 'required|numeric|min:0',
            'Discount_percent' => 'required|numeric|min:0|max:100',
            'status' => 'required|in:active,inactive',
        ]);

        $typeCustomer->update($request->all());

        return redirect()->route('type_customers.index')->with('success', 'Loại khách hàng đã được cập nhật thành công.');
    }

    public function destroy(TypeCustomer $typeCustomer)
    {
        $typeCustomer->delete();

        return redirect()->route('type_customers.index')->with('success', 'Loại khách hàng đã được xóa thành công.');
    }
}
