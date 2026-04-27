@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="flex justify-between items-center mb-12">
        <h1 class="text-3xl font-serif font-bold text-premium-dark">Manage Nighties</h1>
        <a href="/admin/products/create" class="bg-premium-gold text-white px-6 py-3 rounded-xl font-bold hover:bg-premium-gold/90 transition-all flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"></path></svg>
            Add New Nighty
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-8">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-500">Nighty</th>
                    <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-500">Price</th>
                    <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-500">Category</th>
                    <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-500">Status</th>
                    <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-500 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($products as $product)
                <tr class="hover:bg-premium-light/50 transition-colors">
                    <td class="px-8 py-6">
                        <div class="flex items-center space-x-4">
                            <img src="{{ $product->image }}" class="w-12 h-16 object-cover rounded-lg" alt="{{ $product->name }}">
                            <div>
                                <div class="font-bold text-premium-dark">{{ $product->name }}</div>
                                <div class="text-xs text-gray-400">{{ $product->slug }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex flex-col">
                            <span class="font-bold text-premium-dark">₹{{ number_format($product->price, 0) }}</span>
                            @if($product->discount_price)
                            <span class="text-[10px] text-premium-gold font-medium">Disc: ₹{{ number_format($product->discount_price, 0) }}</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-8 py-6 text-sm text-gray-500">
                        {{ $product->category }}
                    </td>
                    <td class="px-8 py-6">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-tighter {{ $product->status == 'Available' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $product->status ?? 'Available' }}
                        </span>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end space-x-3">
                            <a href="/admin/products/{{ $product->id }}/edit" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="/admin/products/{{ $product->id }}" method="POST" onsubmit="return confirm('Delete this nighty?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
