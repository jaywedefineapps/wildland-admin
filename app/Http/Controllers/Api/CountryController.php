<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CityService;
use App\Services\CountryService;
use App\Services\ProvinceService;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    private $countryService;
    private $provinceService;
    private $cityService;
    public function __construct(CountryService $countryService, ProvinceService $provinceService, CityService $cityService)
    {
        $this->countryService = $countryService;
        $this->provinceService = $provinceService;
        $this->cityService = $cityService;
    }

    public function index(Request $request)
    {
        if (!empty($request->countryId)) {
            $response = $this->provinceService->getByCountry($request->countryId);
            return response()->json(['status' => 1, 'message' => trans('message.SUCCESS'), 'type' => 'province', 'response' => $response], 200);
        } else if (!empty($request->provinceId)) {
            $response = $this->cityService->getBYProvince($request->provinceId);
            return response()->json(['status' => 1, 'message' => trans('message.SUCCESS'), 'type' => 'city', 'response' => $response], 200);
        } else if ($request->type == 'cities') {
            $response = $this->cityService->all();
            return response()->json(['status' => 1, 'message' => trans('message.SUCCESS'), 'type' => 'cities', 'response' => $response], 200);
        } else {
            $response = $this->countryService->all();
            return response()->json(['status' => 1, 'message' => trans('message.SUCCESS'), 'type' => 'country', 'response' => $response], 200);
        }
    }
}
