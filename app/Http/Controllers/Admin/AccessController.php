<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AccessService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccessController extends Controller {

    private $accessService;

    public function __construct(AccessService $accessService)
    {
        $this->accessService = $accessService;
    }

    public function index()
    {
        $data['title'] = "Access";
        $data['page'] = "Access List";
        $data['list'] = $this->accessService->all();
        return view('admin.access.access', $data);
    }

    public function create(Request $request)
    {
        $data['title'] = "Access";
        $data['page'] = "Access List";
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "type" => "required",
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => true,
                ",msg" => $validator->fails(),
            ], 422);
        }
        $data['list'] = $this->accessService->createOrUpdate($request->all());
        return 1;
        return view('admin.access.access', $data);
    }

    public function delete(Request $request)
    {
        $this->accessService->delete($request->id);
        return 1;
    }
}
