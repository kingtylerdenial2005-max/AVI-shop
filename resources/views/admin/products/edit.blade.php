@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="mb-12">
        <a href="/admin/products" class="text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-premium-gold flex items-center mb-4 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Products
        </a>
        <h1 class="text-3xl font-serif font-bold text-premium-dark">Edit: {{ $product->name }}</h1>
    </div>

    <form action="/admin/products/{{ $product->id }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 space-y-8">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="md:col-span-2">
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Nighty Name</label>
                <input type="text" name="name" value="{{ $product->name }}" required class="w-full bg-white border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-premium-gold focus:ring-0 transition-all">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Price (₹)</label>
                <input type="number" name="price" value="{{ $product->price }}" required class="w-full bg-white border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-premium-gold focus:ring-0 transition-all">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Discount Price (₹)</label>
                <input type="number" name="discount_price" value="{{ $product->discount_price }}" class="w-full bg-white border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-premium-gold focus:ring-0 transition-all">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Category</label>
                <select name="category" required class="w-full bg-white border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-premium-gold focus:ring-0 transition-all">
                    @foreach(['Nighties', 'Bags', 'Cotton', 'Silk', 'Satin', 'Velvet', 'Kaftan'] as $cat)
                    <option value="{{ $cat }}" {{ $product->category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Status</label>
                <select name="status" required class="w-full bg-white border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-premium-gold focus:ring-0 transition-all">
                    <option value="Available" {{ $product->status == 'Available' ? 'selected' : '' }}>Available</option>
                    <option value="Out of Stock" {{ $product->status == 'Out of Stock' ? 'selected' : '' }}>Out of Stock</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Change Image (Leave empty to keep current)</label>
                <div class="flex items-center space-x-6">
                    <img src="{{ $product->image }}" class="w-16 h-20 object-cover rounded-xl border border-gray-100" alt="Current">
                    <input type="file" name="image" class="flex-1 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-premium-light file:text-premium-dark hover:file:bg-premium-gold hover:file:text-white transition-all">
                </div>
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Description</label>
            <textarea name="description" required rows="4" class="w-full bg-white border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-premium-gold focus:ring-0 transition-all">{{ $product->description }}</textarea>
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="is_featured" id="is_featured" {{ $product->is_featured ? 'checked' : '' }} class="w-5 h-5 text-premium-gold border-gray-300 rounded focus:ring-premium-gold">
            <label for="is_featured" class="ml-3 text-sm font-medium text-gray-700">Feature this product on homepage</label>
        </div>

        <button type="submit" class="w-full bg-premium-dark text-white font-bold py-4 rounded-2xl hover:bg-premium-gold transition-all shadow-xl shadow-black/10">
            Update Nighty
        </button>
    </form>
</div>
@endsection
