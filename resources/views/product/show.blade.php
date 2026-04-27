@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Breadcrumbs -->
    <nav class="flex mb-8 text-sm text-gray-500" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-2">
            <li><a href="/" class="hover:text-premium-gold">Home</a></li>
            <li><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"></path></svg></li>
            <li><a href="/shop?category={{ $product->category }}" class="hover:text-premium-gold">{{ $product->category }}</a></li>
            <li><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"></path></svg></li>
            <li class="text-premium-dark font-medium">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-16">
        <!-- Product Images -->
        <div class="space-y-4">
            <div class="aspect-[4/5] overflow-hidden rounded-3xl bg-gray-100">
                <img src="{{ $product->image }}" class="w-full h-full object-cover" id="main-image" alt="{{ $product->name }}">
            </div>
            <div class="grid grid-cols-4 gap-4">
                <div class="aspect-square rounded-xl overflow-hidden border-2 border-premium-gold cursor-pointer">
                    <img src="{{ $product->image }}" class="w-full h-full object-cover" alt="Thumbnail">
                </div>
                <!-- Additional thumbnails can go here -->
            </div>
        </div>

        <!-- Product Details -->
        <div x-data="{ size: 'L', quantity: 1 }">
            <h1 class="text-3xl md:text-4xl font-serif font-bold text-premium-dark mb-4">{{ $product->name }}</h1>
            <div class="flex items-center space-x-4 mb-6">
                <div class="flex items-center space-x-1">
                    @for($i=0; $i<5; $i++)
                    <svg class="w-4 h-4 {{ $i < floor($product->rating) ? 'text-premium-gold' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    @endfor
                    <span class="text-sm font-medium text-gray-500 ml-1">{{ $product->rating }} Rating</span>
                </div>
                <span class="text-gray-300">|</span>
                <span class="text-sm text-green-600 font-bold uppercase tracking-widest">In Stock</span>
            </div>

            <div class="flex items-baseline space-x-4 mb-8">
                @if($product->discount_price)
                <span class="text-4xl font-bold text-premium-dark">₹{{ number_format($product->discount_price, 0) }}</span>
                <span class="text-xl text-gray-400 line-through">₹{{ number_format($product->price, 0) }}</span>
                <span class="bg-premium-accent/10 text-premium-accent text-xs font-bold px-2 py-1 rounded-md">
                    {{ round((($product->price - $product->discount_price) / $product->price) * 100) }}% OFF
                </span>
                @else
                <span class="text-4xl font-bold text-premium-dark">₹{{ number_format($product->price, 0) }}</span>
                @endif
            </div>

            <p class="text-gray-600 leading-relaxed mb-8">
                {{ $product->description }}
            </p>

            <!-- Options -->
            <div class="space-y-8 mb-10">
                <!-- Size Selection -->
                <div>
                    <h3 class="text-sm font-bold uppercase tracking-widest mb-4">Select Size</h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach(['L', 'XL', 'XXL'] as $s)
                        <button 
                            @click="size = '{{ $s }}'"
                            :class="size === '{{ $s }}' ? 'bg-premium-dark text-white border-premium-dark' : 'bg-white text-gray-700 border-gray-200 hover:border-premium-gold'"
                            class="w-14 h-14 rounded-xl border-2 font-bold transition-all flex items-center justify-center text-sm"
                        >
                            {{ $s }}
                        </button>
                        @endforeach
                    </div>
                </div>

                <!-- Quantity -->
                <div>
                    <h3 class="text-sm font-bold uppercase tracking-widest mb-4">Quantity</h3>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center border-2 border-gray-100 rounded-xl px-2">
                            <button @click="if(quantity > 1) quantity--" class="w-10 h-12 text-xl font-bold text-gray-400 hover:text-premium-dark">-</button>
                            <input type="text" x-model="quantity" class="w-12 text-center border-none focus:ring-0 font-bold" readonly>
                            <button @click="quantity++" class="w-10 h-12 text-xl font-bold text-gray-400 hover:text-premium-dark">+</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                <form action="/cart/add" method="POST" class="flex-1">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="size" :value="size">
                    <input type="hidden" name="quantity" :value="quantity">
                    <button type="submit" class="w-full bg-white border-2 border-premium-dark text-premium-dark font-bold py-4 rounded-2xl hover:bg-premium-dark hover:text-white transition-all transform hover:scale-[1.02]">
                        Add to Cart
                    </button>
                </form>
                <form action="/cart/add" method="POST" class="flex-1">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="size" :value="size">
                    <input type="hidden" name="quantity" :value="quantity">
                    <input type="hidden" name="buy_now" value="1">
                    <button type="submit" class="w-full bg-premium-gold text-white font-bold py-4 rounded-2xl hover:bg-premium-gold/90 shadow-lg shadow-premium-gold/20 transition-all transform hover:scale-[1.02]">
                        Buy It Now
                    </button>
                </form>
            </div>

            <!-- Delivery Info -->
            <div class="mt-10 pt-10 border-t border-gray-100 grid grid-cols-2 gap-6 text-sm">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5 text-premium-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                    <span>Free Shipping on orders above ₹1999</span>
                </div>
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5 text-premium-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    <span>Easy 14 days returns</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Similar Products -->
    @if(count($similarProducts) > 0)
    <section class="mt-24 pt-20 border-t border-gray-100">
        <h2 class="text-3xl font-serif font-bold text-premium-dark mb-12">You May Also Like</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            @foreach($similarProducts as $p)
            <div class="group product-card-hover bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">
                <a href="/product/{{ $p->slug }}" class="block">
                    <div class="aspect-[3/4] overflow-hidden">
                        <img src="{{ $p->image }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" alt="{{ $p->name }}">
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-sm text-premium-dark truncate">{{ $p->name }}</h3>
                        <p class="text-premium-gold font-bold">₹{{ number_format($p->discount_price ?: $p->price, 0) }}</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection
