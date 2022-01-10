<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.admin_login');
    }

    public function dashboard()
    {
        return view('admin.index');
    }

    public function login(Request $request)
    {
        $check = $request->all();
        if (auth()->guard('admin')->attempt([
            'email' => $check['email'],
            'password' => $check['password'],
        ])) {
            return redirect()->route('admin.dashboard')->with('error', 'Admin Login Successfully');
        }

        return back()->with('error', 'Invalid Email Or Password');
    }

    public function logout()
    {
        auth()->guard('admin')->logout();

        return redirect()->route('login_from')->with('error', 'Admin Logout Successfully');

    }
}
