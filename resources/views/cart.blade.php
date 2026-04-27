@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <h1 class="text-4xl font-serif font-bold text-premium-dark mb-12">Your Shopping Bag</h1>

    @if(count($cart) > 0)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
        <!-- Cart Items -->
        <div class="lg:col-span-2 space-y-8">
            @foreach($cart as $id => $item)
            <div class="flex items-center space-x-6 pb-8 border-b border-gray-100 last:border-0">
                <div class="w-32 h-40 flex-shrink-0 rounded-2xl overflow-hidden bg-gray-50">
                    <img src="{{ $item['image'] }}" class="w-full h-full object-cover" alt="{{ $item['name'] }}">
                </div>
                <div class="flex-1">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold text-premium-dark">{{ $item['name'] }}</h3>
                        <form action="/cart/remove" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $id }}">
                            <button type="submit" class="text-gray-400 hover:text-premium-accent transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                    <p class="text-sm text-gray-500 mb-4 uppercase tracking-widest font-medium">Size: {{ $item['size'] }}</p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center border border-gray-100 rounded-lg overflow-hidden">
                            <span class="px-4 py-2 text-sm font-bold bg-gray-50 text-gray-400">Qty: {{ $item['quantity'] }}</span>
                        </div>
                        <span class="text-xl font-bold text-premium-dark">₹{{ number_format($item['price'] * $item['quantity'], 0) }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-50 sticky top-32">
                <h2 class="text-2xl font-serif font-bold text-premium-dark mb-8">Order Summary</h2>
                <div class="space-y-4 mb-8">
                    <div class="flex justify-between text-gray-500">
                        <span>Subtotal</span>
                        <span>₹{{ number_format($total, 0) }}</span>
                    </div>
                    <div class="flex justify-between text-gray-500">
                        <span>Estimated Shipping</span>
                        <span class="text-green-600 font-medium">{{ $total > 1999 ? 'FREE' : '₹99' }}</span>
                    </div>
                    <div class="pt-4 border-t border-gray-100 flex justify-between">
                        <span class="text-xl font-bold text-premium-dark">Total</span>
                        <span class="text-2xl font-bold text-premium-gold">₹{{ number_format($total + ($total > 1999 ? 0 : 99), 0) }}</span>
                    </div>
                </div>
                <a href="/checkout" class="block w-full bg-premium-dark text-white text-center font-bold py-4 rounded-2xl hover:bg-premium-gold transition-all shadow-lg shadow-black/10">
                    Proceed to Checkout
                </a>
                <p class="text-[10px] text-gray-400 text-center mt-6 uppercase tracking-widest font-medium">Safe & Secure Payments</p>
            </div>
        </div>
    </div>
    @else
    <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-gray-200">
        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
        </div>
        <h2 class="text-2xl font-bold text-gray-400 mb-6">Your bag is empty</h2>
        <a href="/" class="inline-block bg-premium-gold text-white font-bold px-10 py-4 rounded-full hover:bg-premium-gold/90 transition-all">Start Shopping</a>
    </div>
    @endif
</div>
@endsection
