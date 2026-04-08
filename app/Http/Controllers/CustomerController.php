<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'cedula' => 'required|unique:customers',
            'phone' => 'required'
        ]);

        Customer::create($request->all());
        return redirect()->route('customers.index')->with('success', 'Cliente creado.');
    }

    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'cedula' => 'required|unique:customers,cedula,' . $customer->id,
            'phone' => 'required'
        ]);

        $customer->update($request->all());
        return redirect()->route('customers.index')->with('success', 'Cliente actualizado.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Cliente eliminado.');
    }
}
