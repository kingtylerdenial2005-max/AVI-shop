<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'discount_price' => $request->discount_price ?: null,
            'category' => $request->category,
            'image' => '/storage/' . $imagePath,
            'rating' => 5.0,
            'is_featured' => $request->has('is_featured'),
            'status' => 'Available'
        ]);

        return redirect('/admin/products')->with('success', 'Nighty added successfully!');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'discount_price' => $request->discount_price ?: null,
            'category' => $request->category,
            'is_featured' => $request->has('is_featured'),
            'status' => $request->status
        ];

        if ($request->hasFile('image')) {
            // Delete old image if it's not a URL
            if (strpos($product->image, '/storage/') !== false) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $product->image));
            }
            
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image'] = '/storage/' . $imagePath;
        }

        $product->update($data);

        return redirect('/admin/products')->with('success', 'Nighty updated successfully!');
    }

    public function destroy(Product $product)
    {
        if (strpos($product->image, '/storage/') !== false) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $product->image));
        }
        $product->delete();
        return redirect('/admin/products')->with('success', 'Nighty deleted successfully!');
    }
}
