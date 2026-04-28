<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AVI Tailoring | Premium Fashion Store</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }

        .product-card-hover:hover {
            transform: translateY(-4px);
            transition: all 0.3s ease;
        }
    </style>
</head>

<body class="bg-premium-light font-sans text-premium-dark antialiased">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-premium-dark/95 backdrop-blur-md border-b border-premium-gold/20"
        x-data="{ mobileMenuOpen: false }">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="/" class="flex items-center">
                        <img src="{{ asset('images/image_1777380181903757.png') }}"
                            class="h-16 w-auto bg-white rounded-lg p-1" style="height: 64px; width: auto;"
                            alt="AVI Tailoring">
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-8">
                    <a href="/"
                        class="text-sm font-medium text-white hover:text-premium-gold transition-colors">Home</a>
                    <a href="/shop?category=Nighties"
                        class="text-sm font-medium text-white hover:text-premium-gold transition-colors">Nighties</a>
                    <a href="/shop?category=Bags"
                        class="text-sm font-medium text-white hover:text-premium-gold transition-colors">Bags</a>
                    <a href="/admin/orders"
                        class="text-sm font-medium text-white hover:text-premium-gold transition-colors">Admin</a>
                </div>

                <!-- Icons -->
                <div class="flex items-center space-x-6 text-white">
                    <div class="hidden md:block relative">
                        <input type="text" placeholder="Search clothes..."
                            class="bg-white/10 border-none rounded-full px-4 py-2 text-sm w-64 focus:ring-1 focus:ring-premium-gold text-white placeholder-white/50">
                    </div>

                    <a href="/cart" class="relative group">
                        <svg class="w-6 h-6 group-hover:text-premium-gold transition-colors" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <span
                            class="absolute -top-2 -right-2 bg-premium-accent text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full"
                            id="cart-count">
                            {{ count(session('cart', [])) }}
                        </span>
                    </a>

                    <button class="md:hidden" @click="mobileMenuOpen = !mobileMenuOpen">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </nav>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-cloak
            class="md:hidden bg-premium-dark border-b border-premium-gold/20 py-4 px-4 space-y-4 shadow-xl absolute w-full transition-all">
            <a href="/" class="block text-base font-medium text-white">Home</a>
            <a href="/shop?category=Nighties" class="block text-base font-medium text-white">Nighties</a>
            <a href="/shop?category=Bags" class="block text-base font-medium text-white">Bags</a>
            <a href="/admin/orders" class="block text-base font-medium text-white">Admin</a>
            <div class="pt-4 border-t border-premium-gold/10">
                <input type="text" placeholder="Search..."
                    class="bg-white/10 border-none rounded-lg px-4 py-3 text-sm w-full text-white placeholder-white/50">
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-premium-dark text-white py-16 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-12">
            <div>
                <img src="{{ asset('images/logo.png') }}" class="h-20 w-auto mb-6 bg-white rounded-lg p-2"
                    alt="AVI Tailoring">
                <p class="text-gray-400 text-sm leading-relaxed">Providing the most comfortable and elegant nighties
                    since 2010. Your comfort is our priority.</p>
            </div>
            <div>
                <h4 class="font-bold mb-6 text-premium-gold uppercase tracking-widest text-xs">Shop</h4>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-premium-gold transition-colors">Cotton Nighties</a></li>
                    <li><a href="#" class="hover:text-premium-gold transition-colors">Satin Nighties</a></li>
                    <li><a href="#" class="hover:text-premium-gold transition-colors">Kaftan Style</a></li>
                    <li><a href="#" class="hover:text-premium-gold transition-colors">New Arrivals</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-6">Support</h4>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-premium-gold transition-colors">Shipping Policy</a></li>
                    <li><a href="#" class="hover:text-premium-gold transition-colors">Returns & Refunds</a></li>
                    <li><a href="#" class="hover:text-premium-gold transition-colors">Sizing Guide</a></li>
                    <li><a href="#" class="hover:text-premium-gold transition-colors">Contact Us</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-6">Contact</h4>
                <p class="text-sm text-gray-400 mb-4">No. 123, Fashion Street, Chennai, Tamil Nadu</p>
                <p class="text-sm text-gray-400 mb-4">Phone: +91 73731 22826</p>
                <div class="flex space-x-4 mt-6">
                    <a href="#" class="text-gray-400 hover:text-premium-gold transition-colors">
                        <span class="sr-only">Facebook</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z">
                            </path>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-premium-gold transition-colors">
                        <span class="sr-only">Instagram</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4s1.791-4 4-4 4 1.79 4 4-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 pt-8 border-t border-white/10 text-center text-sm text-gray-500">
            &copy; 2026 AVI Tailoring. All rights reserved.
        </div>
    </footer>
</body>

</html>