<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\AddressService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    private $addressService;
    public function __construct(AddressService $addressService) {
        $this->addressService = $addressService;
    }

    public function userAddresses() {
        return response()->json(['status' => 1,'message' => trans('message.SUCCESS'), 'response' => $this->addressService->userAddresses(auth()->user()->id)->items()], 200);
    }

    public function manage(Request $request) {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:default,delete,edit,add,details',
        ]);
        $validator->sometimes('addressId', 'required|exists:address,id,deleted_at,NULL', function($input) {
            return $input->type == 'default' || $input->type == 'details' || $input->type == 'delete' || $input->type == 'edit';
        });
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => trans('message.ALL_FIELDS_REQUIRED')],200);
        }
        $type = $request->type;
        $user = auth()->user();
        $addressId = $request->addressId;
        if($type == 'default'){
            $this->addressService->removeDefaultAddress($user->id);
            $this->addressService->setDefaultAddress($addressId);
            return response()->json(['status' => 1, 'message' => trans('message.SUCCESS')], 200);
        }else if($type == 'delete') {
            $this->addressService->delete($addressId);
            return response()->json(['status' => 1, 'message' => trans('message.SUCCESS')], 200);
        }else if($type == 'edit' || $type == 'add') {
            $validator = Validator::make($request->all(), [
                'house_no' => 'required',
                'zipcode' => 'required',
                'address' => 'required',
                'cityId' =>'required|exists:cities,id',
                'provinceId' => 'required|exists:provinces,id',
                'countryId' => 'required|exists:countries,id',
                'addressType' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'message' => $validator->messages()->first()], 200);
            }
            if($type == 'edit') {
                $this->addressService->update($request->addressId,['type' => $request->addressType, 'country_id' => $request->countryId, 'province_id' => $request->provinceId,'city_id' => $request->cityId, 'house_no' => $request->house_no, 'address' => $request->address,'zipcode'=>$request->zipcode]);
            } else {
                $this->addressService->create(['user_id' => auth()->user()->id,'type' => $request->addressType, 'country_id' => $request->countryId, 'province_id' => $request->provinceId, 'city_id' => $request->cityId, 'house_no' => $request->house_no, 'address' => $request->address, 'zipcode'=>$request->zipcode]);
            }
            return response()->json(['status' => 1, 'message' => trans('message.SUCCESS')], 200);
        } else if($type == 'details') {
            return response()->json(['status' => 1, 'message' => trans('message.SUCCESS'), 'response' => $this->addressService->find($addressId)], 200);
        }
    }

}
