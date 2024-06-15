<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use App\Services\UserRoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserRoleController extends Controller
{
    private $userRoleService;
    public function __construct(UserRoleService $userRoleService)
    {
        $this->userRoleService = $userRoleService;
    }

    public function index()
    {
        $data['title'] = "Users";
        $data['page'] = "Users List";
        $data['list'] = $this->userRoleService->all();
        // dd($data['list']);
        return view('admin.userrole.userrole', $data);
        return 1;
    }
    public function autocompleteuserrole(Request $request)
    {
        $data = Role::select("name as value", "id")
            ->where([
                ['name', 'LIKE', $request->get('search') . '%'],
            ])
            ->get();

        return response()->json($data);
    }
    public function create(Request $request)
    {
        // dd($request->all());
        $id = $request->input('id');
        $validator = Validator::make($request->all(), [
            'password' => "required_if:id,null",
            'name' => "required",
            'role_id' => "required",
            'email' => [
                'required',
                'email',
                Rule::unique('admin', 'email')->ignore($id),
                // Rule::unique('investors', 'email')->ignore($id),
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                "error" => true,
                "msg" => $validator->errors(),
            ], 422);
        }
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role_id' => $request->input('role_id'),
        ];
        if ($request->filled('password')) {
            $data['password'] = $request->input('password');
        }
        if (!empty($request->id)) {
            $user = Admin::findOrFail($request->id);
            $user->update($data);
        } else {
            $user = Admin::create($data);
        }
        return 1;
    }
    public function delete(Request $request)
    {
        $this->userRoleService->delete($request->id);
        return 1;
    }
}
