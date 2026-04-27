@extends('layouts.app')

@section('content')
<div x-data="{ 
    orderCount: {{ count($orders) }},
    init() {
        if (localStorage.getItem('lastOrderCount') && {{ count($orders) }} > localStorage.getItem('lastOrderCount')) {
            this.playAlert();
        }
        localStorage.setItem('lastOrderCount', {{ count($orders) }});
        setTimeout(() => window.location.reload(), 15000);
    },
    playAlert() {
        let audio = new Audio('https://assets.mixkit.co/active_storage/sfx/2869/2869-preview.mp3');
        audio.play();
    }
}" x-init="init()">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Header for Admin -->
        <div class="flex justify-between items-center mb-12 border-b border-gray-100 pb-8">
            <div class="flex items-center space-x-4">
                <h1 class="text-3xl font-serif font-bold text-premium-dark">Admin: Live Orders</h1>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 animate-pulse">
                    <span class="w-2 h-2 mr-1.5 bg-green-500 rounded-full"></span>
                    Live
                </span>
            </div>
            <div class="flex items-center space-x-4">
                <a href="/admin/products" class="bg-premium-gold text-white px-6 py-3 rounded-xl font-bold hover:bg-premium-dark transition-all flex items-center shadow-lg shadow-premium-gold/20">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    Manage Products
                </a>
                <form action="/admin/logout" method="POST">
                    @csrf
                    <button type="submit" class="border-2 border-gray-200 text-gray-500 px-6 py-3 rounded-xl font-bold hover:bg-gray-100 transition-all flex items-center">
                        Logout
                    </button>
                </form>
            </div>
        </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-500">Order & Customer</th>
                    <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-500">Items</th>
                    <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-500">Total</th>
                    <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-500">Status</th>
                    <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-500">Payment</th>
                    <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-500 text-right">Date</th>
                    <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-500 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($orders as $order)
                <tr class="hover:bg-premium-light/50 transition-colors">
                    <td class="px-8 py-6">
                        <div class="font-bold text-premium-dark mb-1">{{ $order->order_number }}</div>
                        <div class="text-sm text-gray-500">{{ $order->customer->name }} ({{ $order->customer->phone }})</div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-sm text-gray-600">
                            @foreach($order->items as $item)
                            <div class="whitespace-nowrap">{{ $item->product_name }} x{{ $item->quantity }}</div>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="font-bold text-premium-dark">₹{{ number_format($order->total_amount, 0) }}</span>
                    </td>
                    <td class="px-8 py-6">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-tighter bg-yellow-100 text-yellow-700">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="px-8 py-6 text-sm text-gray-500">
                        {{ $order->payment_method }}
                    </td>
                    <td class="px-8 py-6 text-sm text-gray-500 text-right">
                        {{ $order->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-8 py-6 text-center space-x-2 flex justify-center items-center">
                        <form action="/admin/orders/{{ $order->id }}/status" method="POST" class="inline-block">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()" class="text-xs font-bold uppercase border border-gray-200 rounded px-2 py-1 focus:outline-none focus:border-premium-gold {{ $order->status == 'pending' ? 'bg-yellow-50 text-yellow-700' : 'bg-green-50 text-green-700' }}">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            </select>
                        </form>
                        <form action="/admin/orders/{{ $order->id }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this order?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-white hover:bg-red-500 transition-colors text-xs font-bold uppercase border border-red-500 px-3 py-1 rounded">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        @if(count($orders) == 0)
        <div class="py-20 text-center">
            <p class="text-gray-400 font-medium">No orders found yet.</p>
        </div>
        @endif
    </div>
</div>
@endsection
