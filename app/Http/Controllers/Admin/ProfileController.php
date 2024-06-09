<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Services\AdminService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private $adminService;
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }
    public function edit(){
        // dd(Auth::guard('admin')->id());
        $data['page'] = Str::title('Edit profile');
        $data['title'] = Str::title('Edit profile list');
        return view('admin.profile.profile',$data);
    }
    public function update(Request $request){
        // dd($request->all());
        $id = Auth::guard('admin')->id();
        $data['page'] = Str::title('update profile');
        $data['title'] = Str::title('update profile list');
        $validated = $request->validate([
            'name' => 'required',
        ],[
            'password_confirmation.same' => 'Password Confirmation should match the Password',
        ]);
        if ($request->password != null) {
            $request->validate([
                'password' => 'required',
                'password_confirmation' => 'required|same:password',
            ]);
            $validated['password'] = bcrypt($request->password);
        }
        $this->adminService->profileUpdate($id,['name'=>$request->name,'password'=> Hash::make($request->password)]);
        return back()->with('success', 'Update Profile Successfully!!');
        return view('admin.profile.profile',$data);
    }

}
