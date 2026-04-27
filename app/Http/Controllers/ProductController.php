<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Product::query();

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        $products = $query->latest()->get();
        $featuredProducts = \App\Models\Product::where('is_featured', true)->take(4)->get();

        return view('home', compact('products', 'featuredProducts'));
    }

    public function show($slug)
    {
        $product = \App\Models\Product::where('slug', $slug)->firstOrFail();
        $similarProducts = \App\Models\Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('product.show', compact('product', 'similarProducts'));
    }
}
