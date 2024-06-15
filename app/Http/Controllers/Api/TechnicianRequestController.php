<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\AddressService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services\TechnicianRequestService;

class TechnicianRequestController extends Controller
{
    private $userService;
    private $technicianRequestServie;
    private $addressService;
    public function __construct(UserService $userService,TechnicianRequestService $technicianRequestServie,AddressService $addressService)
    {
        $this->userService = $userService;
        $this->technicianRequestServie = $technicianRequestServie;
        $this->addressService = $addressService;
    }
    public function getListByType(Request $request){
        $validator = Validator::make($request->all(),[
            'type' => 'required|in:pending,completed',
        ]);
        if($validator->fails()) {
            return response()->json(['status' => 0, 'message' => $validator->messages()->first()], 200);
        }
        $response = $this->technicianRequestServie->getListType($request->type,auth()->user()->id);
        return response()->json(['status' => 1,'message' => trans('message.SUCCESS'),'response' => $response->getCollection()], 200);
    }

    public function manageRequestTime(Request $request){
        $validator = Validator::make($request->all(),[
            'type' => 'required|in:in,out',
            'requestId'=>'required',
            // 'time'=>'required'
        ]);
        if($validator->fails()) {
            return response()->json(['status' => 0, 'message' => $validator->messages()->first()], 200);
        }
        if($request->type == 'in'){
            $this->technicianRequestServie->update($request->requestId,['time_in'=>$request->time]);
        }else{
            $this->technicianRequestServie->update($request->requestId,['time_out'=>now(),'status'=>'completed']);
        }
        return response()->json(['status' => 1,'message' => trans('message.SUCCESSFULLY_UPDATED')], 200);
    }
}
