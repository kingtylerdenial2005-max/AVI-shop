@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="mb-12">
        <a href="/admin/products" class="text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-premium-gold flex items-center mb-4 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Products
        </a>
        <h1 class="text-3xl font-serif font-bold text-premium-dark">Add New Nighty</h1>
    </div>

    <form action="/admin/products" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 space-y-8">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="md:col-span-2">
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Nighty Name</label>
                <input type="text" name="name" required class="w-full bg-white border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-premium-gold focus:ring-0 transition-all" placeholder="e.g. Premium Silk Nighty">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Price (₹)</label>
                <input type="number" name="price" required class="w-full bg-white border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-premium-gold focus:ring-0 transition-all" placeholder="799">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Discount Price (₹) - Optional</label>
                <input type="number" name="discount_price" class="w-full bg-white border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-premium-gold focus:ring-0 transition-all" placeholder="699">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Category</label>
                <select name="category" required class="w-full bg-white border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-premium-gold focus:ring-0 transition-all">
                    <option value="Nighties">Nighties</option>
                    <option value="Bags">Bags</option>
                    <option value="Cotton">Cotton</option>
                    <option value="Silk">Silk</option>
                    <option value="Satin">Satin</option>
                    <option value="Velvet">Velvet</option>
                    <option value="Kaftan">Kaftan</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Product Image</label>
                <input type="file" name="image" required class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-premium-light file:text-premium-dark hover:file:bg-premium-gold hover:file:text-white transition-all">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Description</label>
            <textarea name="description" required rows="4" class="w-full bg-white border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-premium-gold focus:ring-0 transition-all" placeholder="Write about the fabric, comfort, and style..."></textarea>
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="is_featured" id="is_featured" class="w-5 h-5 text-premium-gold border-gray-300 rounded focus:ring-premium-gold">
            <label for="is_featured" class="ml-3 text-sm font-medium text-gray-700">Feature this product on homepage</label>
        </div>

        <button type="submit" class="w-full bg-premium-dark text-white font-bold py-4 rounded-2xl hover:bg-premium-gold transition-all shadow-xl shadow-black/10">
            Save Nighty
        </button>
    </form>
</div>
@endsection
