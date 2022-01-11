<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function registerShow()
    {
        return view('admin.admin_register');
    }

    public function register(Request $request)
    {
        Admin::create($request->only([
            'name',
            'email',
            'password',
        ]));

        return redirect()->route('login_from')->with('error', 'Admin Create Successfully');
    }
}
