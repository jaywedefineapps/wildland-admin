<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserValveService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserValveController extends Controller
{
    private $userValveService;
    public function __construct(UserValveService $userValveService) {
        $this->userValveService = $userValveService;
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'valveApiKey' => 'required',
            'addressId' => 'required',
        ]);
        if($validator->fails()) {
            return response()->json(['status' => 0, 'message' => $validator->messages()->first()], 200);
        }
        $this->userValveService->deleteByUidAndKey(auth()->user()->id,$request->valveApiKey);
        $this->userValveService->create(['user_id'=>auth()->user()->id,'valve_api_key'=>$request->valveApiKey,'address_id'=>$request->addressId]);
        return response()->json(['status' => 1,'message' => trans('message.SUCCESS')], 200);
    }

    public function getValvByAddress(Request $request){
        $validator = Validator::make($request->all(),[
            'addressId' => 'required',
        ]);
        if($validator->fails()) {
            return response()->json(['status' => 0, 'message' => $validator->messages()->first()], 200);
        }
        $response =  $this->userValveService->getByAddressId($request->addressId);
        return response()->json(['status' => 1,'message' => trans('message.SUCCESS'),'response'=>$response], 200);
    }

}
