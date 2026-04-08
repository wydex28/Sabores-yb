<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'items.product')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        // Typically, orders might be created from the frontend, but we can make a basic one or just leave it for now.
        return redirect()->route('orders.index')->with('success', 'La creación manual de órdenes estará disponible pronto.');
    }

    public function store(Request $request)
    {
        // 
    }

    public function show(Order $order)
    {
        $order->load('items.product', 'user');
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $order->update(['status' => $request->status]);
        return redirect()->route('orders.index')->with('success', 'Estado de orden actualizado.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Orden eliminada.');
    }
}
