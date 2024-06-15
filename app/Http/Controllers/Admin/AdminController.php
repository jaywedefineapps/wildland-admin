<?php

namespace App\Http\Controllers\Admin;

use App\Models\RoleAccess;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
            dump('login done');
            $role_id = auth()->guard('admin')->user()->role_id;
            dump('role id');
            dump($role_id);
            $data['roleAccesses'] = RoleAccess::select('type')
                ->join('accesses', 'accesses.id', 'role_accesses.access_id')
                ->where('role_id', $role_id)
                ->pluck('type')
                ->toArray();
            dump($data['roleAccesses']);
            Session::put(['roleAccesses' => $data['roleAccesses']]);
            dd(Session::get('roleAccesses'));
            return redirect()->route('admin.dashboard')->with('success', 'Admin Login Successfully');
        } else {
            dd('not login');
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
