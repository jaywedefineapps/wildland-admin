<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Access;
use App\Models\Role;
use App\Models\RoleAccess;
use Illuminate\Http\Request;

class RoleAccessController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = "Role";
        $data['page'] = "Role List";
        $data['list'] = Access::all();
        $data['roles'] = Role::all();
        $data['rolesWithCount'] = Role::withCount('roleAccess')->latest('created_at')->get();
        return view('admin.role.role', $data);
    }

    public function create(Request $request)
    {
        $id = $request->id;
        $data['title'] = "Role";
        $data['page'] = "Role List";
        $data['rolesWithCount'] = Role::withCount('roleAccess')->latest('created_at')->get();
        $role = Role::updateOrCreate(['id' => $id], ['name' => $request->name]);
        RoleAccess::where('role_id', $role->id)->forceDelete();
        $accessIds = $request->access_id;
        foreach ($accessIds as $id) {
            RoleAccess::create(['role_id' => $role->id, 'access_id' => $id]);
        }
        $data['list'] = RoleAccess::all();
        return view('admin.role.role', $data);
    }

    public function rolesdelected(Request $request)
    {
        $response = RoleAccess::join('accesses', 'accesses.id', 'role_accesses.access_id')->where('role_id', $request->id)->get();
        return $response;
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        Role::where('id', $id)->delete();
        RoleAccess::where('role_id', $id)->delete();
        return 1;
    }
}
