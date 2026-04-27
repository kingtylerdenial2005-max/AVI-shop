<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        if (session('admin_logged_in')) {
            return redirect('/admin/orders');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $username = config('app.admin_username') ?: env('ADMIN_USERNAME');
        $password = config('app.admin_password') ?: env('ADMIN_PASSWORD');

        if ($request->username === $username && $request->password === $password) {
            session(['admin_logged_in' => true]);
            return redirect('/admin/orders');
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect('/admin/login');
    }
}
