<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\UserCameraService;
use App\Http\Controllers\Controller;
use App\Services\CameraScreenshotService;

class UserCameraController extends Controller
{
    private $userService;
    private $userCameraService;
    private $camerassService;

    public function __construct(UserService $userService,UserCameraService $userCameraService,CameraScreenshotService $camerassService)
    {
        $this->userService = $userService;
        $this->userCameraService = $userCameraService;
        $this->camerassService = $camerassService;

    }
    public function list(Request $request){
        $data['page'] = "User Camera";
        $data['title'] = "User Camera  List";
        $data['list'] = $this->userCameraService->getByUserIdPaginate($request->id);
        return view('admin.camera.list', $data);
    }
    public function delete(Request $request)
    {
        $this->camerassService->deleteByCameraId($request->id);
        $this->userCameraService->delete($request->id);
        return 1;
    }
}
