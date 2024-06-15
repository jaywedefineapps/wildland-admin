<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\UserCameraService;
use App\Http\Controllers\Controller;

class UserCameraController extends Controller
{
    private $userService;
    private $userCameraService;
    public function __construct(UserService $userService,UserCameraService $userCameraService)
    {
        $this->userService = $userService;
        $this->userCameraService = $userCameraService;
    }
    public function list(Request $request){
        $data['page'] = "User Camera";
        $data['title'] = "User Camera  List";
        $data['list'] = $this->userCameraService->getByUserIdPaginate($request->id);
        return view('admin.camera.list', $data);
    }
    public function delete(Request $request)
    {
        $this->userCameraService->delete($request->id);
        return 1;
    }
}
