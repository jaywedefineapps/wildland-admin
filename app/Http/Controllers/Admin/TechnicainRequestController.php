<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\AddressService;
use App\Http\Controllers\Controller;
use App\Services\TechnicianRequestService;
use Illuminate\Support\Facades\Validator;

class TechnicainRequestController extends Controller
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
    public function pending(Request $request){
        $data['page'] = "Technician Pending Requests";
        $data['title'] = "Technician Pending Requests List";
        $data['list'] = $this->technicianRequestServie->getListByType('pending');
        $data['users'] = $this->userService->activeUsers($request);
        $data['technicians'] = $this->userService->activeTechnician($request);
        $data['type'] = 'pending';
        return view('admin.technicianrequest.list', $data);
    }
    public function completed(Request $request){
        $data['page'] = "Technician Completed Requests";
        $data['title'] = "Technician Completed Requests List";
        $data['list'] = $this->technicianRequestServie->getListByType('completed');
        $data['users'] = $this->userService->activeUsers($request);
        $data['technicians'] = $this->userService->activeTechnician($request);
        $data['type'] = 'completed';
        return view('admin.technicianrequest.list', $data);
    }
    public function getAddress(Request $request){
        return $this->addressService->userAddressesAll($request->id);
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'address_id' => 'required',
            'technician_id' => 'required',
            'date' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'msg' => $validator->errors(),
            ], 422);
        }
        $request->merge(['status'=>'pending']);
        $this->technicianRequestServie->createOrUpdate($request->all());
        return 1;
    }
    public function delete(Request $request)
    {
        $this->technicianRequestServie->delete($request->id);
        return 1;
    }
}
