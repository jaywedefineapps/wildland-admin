<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\CityService;
use App\Services\UserService;
use App\Services\AddressService;
use App\Services\CountryService;
use App\Services\ProvinceService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    private $userService;
    private $countryService;
    private $provinceService;
    private $cityService;
    private $addressService;
    public function __construct(UserService $userService, CountryService $countryService,AddressService $addressService,ProvinceService $provinceService,CityService $cityService)
    {
        $this->userService = $userService;
        $this->countryService = $countryService;
        $this->addressService = $addressService;
        $this->provinceService = $provinceService;
        $this->cityService = $cityService;
    }

    public function list(Request $request){
        $data['page'] = "Address";
        $data['title'] = "Address Listing";
        $data['list'] = $this->addressService->userAddresses($request->id);
        $data['countries'] = $this->countryService->all();
        $data['type'] = "users";
        return view('admin.address.list', $data);
    }
    public function delete(Request $request)
    {
        $this->addressService->delete($request->id);
        return 1;
    }
    public function getProvince(Request $request){
        return $this->provinceService->getByCountry($request->id);
    }
    public function getCity(Request $request){
        return $this->cityService->getBYProvince($request->id);
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'house_no' => 'required',
            'address' => 'required',
            'country_id' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'zipcode' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'msg' => $validator->errors(),
            ], 422);
        }
        $this->addressService->createOrUpdate($request->all());
        return 1;
    }
    public function makeDefualt(Request $request){
        $this->addressService->update($request->id,['is_default'=>$request->is_default]);
        return 1;
    }
}
