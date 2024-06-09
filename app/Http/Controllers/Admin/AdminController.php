<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index() {
        return view('admin/sign-in');
    }

    public function login(Request $request) {
        if($request->has('email') && $request->has('password')){
        if (Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            Auth::guard('business')->logout();
            return redirect()->route('admin.dashboard')->with('success', 'Admin Login Successfully');
        } else {
            return back()->with('error', 'Invalid Email Or Password');
        }
    }
        return redirect()->route('login_form');
    }
    public function dashboard() {
        return view('admin.dashboard');
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('login_form')->with('success', 'Logout Successfully!!');
    }
}
