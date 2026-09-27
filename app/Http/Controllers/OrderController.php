<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout(Request $request, Product $product)
    {
        $request->validate([
            'service_type' => 'required|in:lcd_only,with_installation',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string'
        ]);

        $serviceFee = ($request->service_type === 'with_installation') ? $product->installation_fee : 0;
        $total = ($product->price_lcd_only * $request->quantity) + $serviceFee;

        $order = Order::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'service_type' => $request->service_type,
            'quantity' => $request->quantity,
            'product_price' => $product->price_lcd_only,
            'service_fee' => $serviceFee,
            'total_amount' => $total,
            'notes' => $request->notes,
            'status' => 'pending'
        ]);

        return redirect()->route('orders.my')->with('success', 'Pesanan berhasil dibuat!');
    }

    public function myOrders()
    {
        $orders = Order::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }
}