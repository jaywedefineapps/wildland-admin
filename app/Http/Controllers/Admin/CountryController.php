<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CountryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    private $countryService;
    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    public function index()
    {
        $data['page'] = "Countries";
        $data['title'] = "Country List";
        $data['list'] = $this->countryService->all();
        return view('admin.country.country', $data);
    }

    public function create(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => "required|unique:countries,name," . $request->id . ",id,deleted_at,NULL",
            'code' => "required|unique:countries,code," . $request->id . ",id,deleted_at,NULL",
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'msg' => $validator->errors(),
            ], 422);
        }
        if ($request->default == 'on') {
            $this->countryService->removeDefault();
            $request->merge([
                'default' => 1,
            ]);
        } else {
            $request->request->remove('default');
        }
        $this->countryService->createOrUpdate($request->all());
        return 1;
    }

    public function delete(Request $request)
    {
        $this->countryService->delete($request->id);
        return 1;
    }
}
