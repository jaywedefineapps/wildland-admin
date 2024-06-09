<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CountryService;
use App\Services\ProvinceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProvinceController extends Controller
{
    private $provinceService;
    private $countryService;
    public function __construct(ProvinceService $provinceService, CountryService $countryService)
    {
        $this->provinceService = $provinceService;
        $this->countryService = $countryService;
    }

    public function index()
    {
        $data['page'] = "Provinces";
        $data['title'] = "Provinces List";
        $data['list'] = $this->provinceService->all();
        $data['countries'] = $this->countryService->all();
        return view('admin.province.province', $data);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:provinces,name,' . $request->id . ',id,deleted_at,NULL',
            'country_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'msg' => $validator->errors(),
            ], 422);
        }
        $this->provinceService->createOrUpdate($request->all());
        return 1;
    }

    public function delete(Request $request)
    {
        $this->provinceService->delete($request->id);
        return 1;
    }
}
