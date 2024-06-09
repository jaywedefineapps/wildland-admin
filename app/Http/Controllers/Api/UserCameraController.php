<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CameraScreenshotService;
use App\Services\UserCameraService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserCameraController extends Controller
{
    private $userCameraService;
    private $camerassService;
    public function __construct(UserCameraService $userCameraService,CameraScreenshotService $camerassService) {
        $this->userCameraService = $userCameraService;
        $this->camerassService = $camerassService;
    }
    public function createCamera(Request $request){
        $validator = Validator::make($request->all(),[
            'addressId' => 'required',
            'port' => 'required',
            'ipAddress' => 'required',
            'deviceName' => 'required',
            'userName' => 'required',
            'password' => 'required',
            'channels' => 'required|array',
        ]);
        if($validator->fails()) {
            return response()->json(['status' => 0, 'message' => $validator->messages()->first()], 200);
        }
        $data = [
            'user_id'=>auth()->user()->id,
            'address_id'=>$request->addressId,
            'port'=>$request->port,
            'ip_address'=>$request->ipAddress,
            'device_name'=>$request->deviceName,
            'user_name'=>$request->userName,
            'password'=>$request->password,
        ];
        $camera =  $this->userCameraService->create($data);

        foreach ($request->channels as $key => $value) {
            $this->camerassService->create(['camera_id'=>$camera->id,'channel_no'=>$value['no'],'image'=>null,'user_id'=>auth()->user()->id]);
        }

        return response()->json(['status' => 1,'message' => trans('message.SUCCESS')], 200);
    }
    public function list(Request $request){
        $response = $this->userCameraService->getByUserId(auth()->user()->id);
        return response()->json(['status' => 1,'message' => trans('message.SUCCESS'),'response' => $response], 200);
    }
    public function delete(Request $request){
        $validator = Validator::make($request->all(),[
            'id' => 'required|exists:user_cameras,id',
        ]);
        if($validator->fails()) {
            return response()->json(['status' => 0, 'message' => $validator->messages()->first()], 200);
        }
        $response = $this->userCameraService->deleteNew($request->id);
        return response()->json(['status' => 1,'message' => trans('message.SUCCESS')], 200);
    }
    public function details(Request $request){
        $validator = Validator::make($request->all(),[
            'id' => 'required|exists:user_cameras,id',
        ]);
        if($validator->fails()) {
            return response()->json(['status' => 0, 'message' => $validator->messages()->first()], 200);
        }
        $response = $this->userCameraService->find($request->id);
        return response()->json(['status' => 1,'message' => trans('message.SUCCESS'),'response' => $response], 200);
    }

    public function checkCameraExist(Request $request){
        $validator = Validator::make($request->all(),[
            'port' => 'required',
            'ipAddress' => 'required',
        ]);
        if($validator->fails()) {
            return response()->json(['status' => 0, 'message' => $validator->messages()->first()], 200);
        }
        $data = $this->userCameraService->getByIpUidPort($request->ipAddress,$request->port,auth()->user()->id);
        // dd($data);
        if($data->count() != 0){
            return response()->json(['status' => 0, 'message' => 'This device is already added'], 200);
        }else{
            return response()->json(['status' => 1, 'message' => 'Device not found'], 200);
        }
    }
} 
