@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center px-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-serif font-bold text-premium-dark mb-2">Admin Login</h1>
            <p class="text-gray-500">Access your dashboard</p>
        </div>

        @if(session('error'))
        <div class="bg-red-50 text-red-600 p-4 rounded-2xl mb-6 text-sm font-medium text-center border border-red-100">
            {{ session('error') }}
        </div>
        @endif

        <form action="/admin/login" method="POST" class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 space-y-6">
            @csrf
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Username</label>
                <input type="text" name="username" required class="w-full bg-gray-50 border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-premium-gold focus:ring-0 transition-all outline-none" placeholder="Enter username">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Password</label>
                <input type="password" name="password" required class="w-full bg-gray-50 border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-premium-gold focus:ring-0 transition-all outline-none" placeholder="Enter password">
            </div>

            <button type="submit" class="w-full bg-premium-dark text-white font-bold py-4 rounded-2xl hover:bg-premium-gold transition-all shadow-xl shadow-black/10">
                Log In to Admin
            </button>
        </form>
        
        <div class="mt-8 text-center">
            <a href="/" class="text-sm text-gray-400 hover:text-premium-gold transition-colors">← Back to Store</a>
        </div>
    </div>
</div>
@endsection
