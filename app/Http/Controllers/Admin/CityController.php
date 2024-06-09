<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CityService;
use App\Services\ProvinceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    private $cityService;
    private $provinceService;
    public function __construct(CityService $cityService, ProvinceService $provinceService)
    {
        $this->cityService = $cityService;
        $this->provinceService = $provinceService;
    }
    public function index()
    {
        $data['page'] = "Cities";
        $data['title'] = "Cities List";
        $data['list'] = $this->cityService->all();
        $data['provinces'] = $this->provinceService->all();
        return view('admin.city.city', $data);
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'province_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'msg' => $validator->errors(),
            ], 422);
        }
        $this->cityService->createOrUpdate($request->all());
        return 1;
    }
    public function delete(Request $request)
    {
        $this->cityService->delete($request->id);
        return 1;
    }
}
