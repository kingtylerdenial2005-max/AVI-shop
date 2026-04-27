@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
        <!-- Checkout Form -->
        <div>
            <h1 class="text-4xl font-serif font-bold text-premium-dark mb-12">Checkout</h1>
            
            <form action="/place-order" method="POST" class="space-y-10">
                @csrf
                <!-- Shipping Address -->
                <div>
                    <h2 class="text-xl font-bold text-premium-dark mb-6 flex items-center">
                        <span class="w-8 h-8 bg-premium-dark text-white rounded-full flex items-center justify-center mr-3 text-sm">1</span>
                        Shipping Information
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Full Name</label>
                            <input type="text" name="name" required class="w-full bg-white border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-premium-gold focus:ring-0 transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Phone Number</label>
                            <input type="text" name="phone" required class="w-full bg-white border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-premium-gold focus:ring-0 transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Location (City/Area)</label>
                            <input type="text" name="location" required class="w-full bg-white border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-premium-gold focus:ring-0 transition-all">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Full Address</label>
                            <textarea name="address" required rows="3" class="w-full bg-white border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-premium-gold focus:ring-0 transition-all"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div x-data="{ payment: 'UPI' }">
                    <h2 class="text-xl font-bold text-premium-dark mb-6 flex items-center">
                        <span class="w-8 h-8 bg-premium-dark text-white rounded-full flex items-center justify-center mr-3 text-sm">2</span>
                        Payment Method
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                        <label class="relative flex items-center p-4 border-2 rounded-2xl cursor-pointer transition-all group" :class="payment === 'UPI' ? 'border-premium-gold bg-premium-light/30' : 'border-gray-100'">
                            <input type="radio" name="payment_method" value="UPI" x-model="payment" class="hidden">
                            <div class="w-5 h-5 border-2 border-gray-200 rounded-full mr-4 relative" :class="payment === 'UPI' ? 'border-premium-gold bg-premium-gold' : ''">
                                <div class="absolute inset-1 bg-white rounded-full" x-show="payment === 'UPI'"></div>
                            </div>
                            <div class="flex-1">
                                <span class="block font-bold text-premium-dark">GPay / PhonePe</span>
                                <span class="text-xs text-gray-400">Scan & Pay</span>
                            </div>
                        </label>
                        
                        <label class="relative flex items-center p-4 border-2 rounded-2xl cursor-pointer transition-all group" :class="payment === 'COD' ? 'border-premium-gold bg-premium-light/30' : 'border-gray-100'">
                            <input type="radio" name="payment_method" value="COD" x-model="payment" class="hidden">
                            <div class="w-5 h-5 border-2 border-gray-200 rounded-full mr-4 relative" :class="payment === 'COD' ? 'border-premium-gold bg-premium-gold' : ''">
                                <div class="absolute inset-1 bg-white rounded-full" x-show="payment === 'COD'"></div>
                            </div>
                            <div class="flex-1">
                                <span class="block font-bold text-premium-dark">Cash On Delivery</span>
                                <span class="text-xs text-gray-400">Pay at doorstep</span>
                            </div>
                        </label>
                    </div>

                    <!-- UPI QR Section -->
                    <div x-show="payment === 'UPI'" x-cloak class="p-6 bg-white border-2 border-premium-gold rounded-3xl text-center mb-8 animate-fade-in">
                        <p class="text-xs font-bold text-premium-gold uppercase tracking-widest mb-4">Scan QR to Pay ₹{{ number_format($total, 0) }}</p>
                        <div class="w-48 h-48 bg-gray-100 mx-auto rounded-2xl flex items-center justify-center mb-4 border-2 border-gray-50 relative overflow-hidden">
                            <!-- Placeholder QR -->
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=upi://pay?pa=9361699627@okicici&pn=AVI%20Nighties&am={{ $total }}&cu=INR" class="w-full h-full p-4" alt="UPI QR">
                        </div>
                        <p class="text-[10px] text-gray-400 font-medium">After payment, click "Place Order" below</p>
                    </div>
                </div>

                <button type="submit" class="w-full bg-premium-gold text-white font-bold py-5 rounded-2xl hover:bg-premium-gold/90 shadow-xl shadow-premium-gold/30 transition-all transform hover:scale-[1.02] text-lg uppercase tracking-widest">
                    Place Order
                </button>
            </form>
        </div>

        <!-- Order Summary -->
        <div>
            <div class="bg-white rounded-3xl p-10 shadow-sm border border-gray-50 sticky top-32">
                <h2 class="text-2xl font-serif font-bold text-premium-dark mb-8">Review Order</h2>
                <div class="space-y-6 mb-10">
                    @foreach($cart as $item)
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-20 bg-gray-50 rounded-xl overflow-hidden flex-shrink-0">
                            <img src="{{ $item['image'] }}" class="w-full h-full object-cover" alt="{{ $item['name'] }}">
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-bold text-sm text-premium-dark truncate">{{ $item['name'] }}</h4>
                            <p class="text-[10px] text-gray-400 uppercase tracking-tighter">Size: {{ $item['size'] }} | Qty: {{ $item['quantity'] }}</p>
                        </div>
                        <span class="font-bold text-sm text-premium-dark">₹{{ number_format($item['price'] * $item['quantity'], 0) }}</span>
                    </div>
                    @endforeach
                </div>
                
                <div class="space-y-4 pt-6 border-t border-gray-50">
                    <div class="flex justify-between text-gray-500 text-sm">
                        <span>Subtotal</span>
                        <span>₹{{ number_format($subtotal, 0) }}</span>
                    </div>
                    <div class="flex justify-between text-gray-500 text-sm">
                        <span>Shipping Fee</span>
                        <span class="{{ $shipping == 0 ? 'text-green-600 font-bold' : '' }}">{{ $shipping == 0 ? 'FREE' : '₹' . $shipping }}</span>
                    </div>
                    <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                        <span class="text-xl font-serif font-bold text-premium-dark">Total Amount</span>
                        <span class="text-3xl font-bold text-premium-gold">₹{{ number_format($total, 0) }}</span>
                    </div>
                </div>

                <div class="mt-10 p-4 bg-premium-light rounded-2xl flex items-start space-x-4">
                    <svg class="w-6 h-6 text-premium-gold mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-[11px] text-gray-500 leading-relaxed uppercase tracking-widest font-medium">
                        Your order details will be securely processed and confirmed.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
