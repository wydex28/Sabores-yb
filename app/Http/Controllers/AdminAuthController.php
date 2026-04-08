<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $adminPassword = env('ADMIN_PASSWORD', 'admin123'); 
        $superAdminPassword = env('SUPER_ADMIN_PASSWORD', 'SABORES2026');

        if ($request->password === $superAdminPassword) {
            $request->session()->put('super_admin_logged_in', true);
            return redirect()->route('superadmin.index');
        }

        if ($request->password === $adminPassword) {
            $request->session()->put('admin_logged_in', true);
            return redirect()->route('admin.index');
        }

        return back()->withErrors(['password' => 'Contraseña incorrecta.']);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_logged_in');
        $request->session()->forget('super_admin_logged_in');
        return redirect('/');
    }
}
