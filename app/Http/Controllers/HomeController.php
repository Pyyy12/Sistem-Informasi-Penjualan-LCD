<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        if ($request->filled('os')) {
            $query->where('os_type', $request->os);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(9);
        $brands = Product::select('brand')->distinct()->pluck('brand');

        return view('home', compact('products', 'brands'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}