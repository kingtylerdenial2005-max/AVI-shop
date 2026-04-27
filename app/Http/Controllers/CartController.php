<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $product = \App\Models\Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        $cartId = $product->id . '-' . $request->size;

        if (isset($cart[$cartId])) {
            $cart[$cartId]['quantity'] += $request->quantity;
        } else {
            $cart[$cartId] = [
                "id" => $product->id,
                "name" => $product->name,
                "quantity" => (int)$request->quantity,
                "price" => $product->discount_price ?: $product->price,
                "image" => $product->image,
                "size" => $request->size
            ];
        }

        session()->put('cart', $cart);
        
        if ($request->has('buy_now')) {
            return redirect('/checkout');
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Product removed successfully');
        }
    }
}
