@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
    <!-- Success Animation/Icon -->
    <div class="mb-8 flex justify-center">
        <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center animate-bounce">
            <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"></path></svg>
        </div>
    </div>

    <h1 class="text-4xl font-serif font-bold text-premium-dark mb-4">Order Placed Successfully!</h1>
    <p class="text-gray-500 mb-8 max-w-md mx-auto">Thank you for shopping with AVI Nighties. Your order #{{ $order->order_number }} has been recorded and our team has been notified via Telegram.</p>

    <div class="bg-white rounded-3xl border border-gray-100 p-8 mb-12 shadow-sm">
        <div class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4">Order Summary</div>
        <div class="flex justify-between items-center mb-2">
            <span class="text-gray-500">Order Number:</span>
            <span class="font-bold text-premium-dark">#{{ $order->order_number }}</span>
        </div>
        <div class="flex justify-between items-center">
            <span class="text-gray-500">Total Amount:</span>
            <span class="font-bold text-premium-gold text-xl">₹{{ number_format($order->total_amount, 0) }}</span>
        </div>
    </div>

    <div class="space-y-4">
        @if($upiLink)
        <a href="{{ $upiLink }}" class="block w-full bg-premium-dark text-white font-bold py-5 rounded-2xl hover:bg-premium-gold transition-all flex items-center justify-center text-lg shadow-xl shadow-black/10">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            Pay Now via GPay / UPI
        </a>
        <p class="text-xs text-gray-400 font-medium uppercase tracking-widest">Or pay on delivery if selected</p>
        @endif

        <a href="/" class="block w-full border-2 border-premium-dark text-premium-dark font-bold py-4 rounded-2xl hover:bg-premium-dark hover:text-white transition-all">
            Return to Homepage
        </a>
    </div>
</div>
@endsection
