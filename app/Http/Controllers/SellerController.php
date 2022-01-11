<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index()
    {
        return view('seller.seller_login');
    }

    public function dashboard()
    {
        return view('seller.index');
    }

    public function login(Request $request)
    {
        $check = $request->all();
        if (auth()->guard('seller')->attempt([
            'email' => $check['email'],
            'password' => $check['password'],
        ])) {
            
            return redirect()->route('seller.dashboard')->with('error', 'Seller Login Successfully');
        }

        return back()->with('error', 'Invalid Email Or Password');
    }

    public function logout()
    {
        auth()->guard('seller')->logout();

        return redirect()->route('seller_login_from')->with('error', 'Seller Logout Successfully');
    }

    public function registerShow()
    {
        return view('seller.seller_register');
    }

    public function register(Request $request)
    {
        Seller::create($request->only([
            'name',
            'email',
            'password',
        ]));

        return redirect()->route('seller_login_from')->with('error', 'Seller Create Successfully');
    }
}
