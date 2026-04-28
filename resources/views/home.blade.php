@extends('layouts.app')

@section('content')
    <!-- Simple Header/Search Section -->
    <section class="bg-white border-b border-gray-100 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h1 class="text-3xl font-serif font-bold text-premium-dark">AVI Nighties</h1>
                    <p class="text-sm text-gray-500 mt-1">Showing all luxury sleepwear collections</p>
                </div>

                <div class="relative w-full md:w-96">
                    <input type="text" placeholder="Search for nighties..."
                        class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-6 py-3 text-sm focus:border-premium-gold focus:ring-0 transition-all">
                    <button class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-premium-gold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Listing Section -->
    <section id="products" class="py-12 bg-premium-light min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Results count and Filter placeholder -->
            <div class="flex justify-between items-center mb-10">
                <span class="text-xs font-bold uppercase tracking-widest text-gray-400">{{ count($products) }} Results
                    Found</span>
                <div
                    class="flex items-center space-x-2 text-sm font-medium text-premium-dark cursor-pointer hover:text-premium-gold transition-colors">
                    <span>Sort by: Featured</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6 md:gap-8">
                @foreach($products as $product)
                    <div
                        class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full border border-gray-50">
                        <a href="/product/{{ $product->slug }}" class="flex-1">
                            <div class="relative aspect-[3/4] overflow-hidden">
                                <img src="{{ $product->image }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                    alt="{{ $product->name }}">
                                @if($product->discount_price)
                                    <div
                                        class="absolute top-3 left-3 bg-premium-accent text-white text-[9px] font-bold px-2 py-0.5 rounded-full uppercase tracking-tighter shadow-sm">
                                        -{{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%
                                    </div>
                                @endif
                            </div>

                            <div class="p-4 flex flex-col h-fit">
                                <div class="flex items-center space-x-1 mb-2">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="w-3 h-3 {{ $i < floor($product->rating) ? 'text-premium-gold' : 'text-gray-200' }}"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                    @endfor
                                    <span class="text-[10px] text-gray-400">({{ number_format($product->rating, 1) }})</span>
                                </div>

                                <h3
                                    class="font-bold text-premium-dark text-sm mb-1 line-clamp-2 leading-snug group-hover:text-premium-gold transition-colors">
                                    {{ $product->name }}</h3>

                                <div class="mt-auto pt-2">
                                    <div class="flex items-baseline space-x-2">
                                        @if($product->discount_price)
                                            <span
                                                class="text-premium-dark font-bold text-base">₹{{ number_format($product->discount_price, 0) }}</span>
                                            <span
                                                class="text-gray-400 text-[10px] line-through font-medium">₹{{ number_format($product->price, 0) }}</span>
                                        @else
                                            <span
                                                class="text-premium-dark font-bold text-base">₹{{ number_format($product->price, 0) }}</span>
                                        @endif
                                    </div>
                                    <p class="text-[10px] text-green-600 font-bold mt-1 uppercase tracking-tighter">Free
                                        Delivery</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection