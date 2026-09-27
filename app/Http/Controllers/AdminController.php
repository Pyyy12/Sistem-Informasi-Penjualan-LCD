<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');
        $totalProducts = Product::count();
        $recentOrders = Order::with(['user', 'product'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalOrders', 'totalRevenue', 'totalProducts', 'recentOrders'));
    }

    public function products()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'brand' => 'required|string',
            'os_type' => 'required|in:iPhone,Android',
            'price_lcd_only' => 'required|numeric|min:0',
            'installation_fee' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|url',
            'description' => 'nullable|string'
        ]);

        Product::create($validated);
        return back()->with('success', 'Produk LCD berhasil ditambahkan!');
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Produk berhasil dihapus!');
    }

    public function orders()
    {
        $orders = Order::with(['user', 'product'])->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $order->update(['status' => $request->status]);
        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}