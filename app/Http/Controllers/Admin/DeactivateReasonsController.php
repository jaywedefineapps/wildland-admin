<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DeactivateReasonService;
use Illuminate\Support\Facades\Validator;

class DeactivateReasonsController extends Controller
{
    private $deactivateReasonService;
    public function __construct(DeactivateReasonService $deactivateReasonService)
    {
        $this->deactivateReasonService = $deactivateReasonService;
    }
    public function index(){
        $data['title'] = "Deactivate Reason";
        $data['page']  = "Deactivate Reason List";
        $data['list'] = $this->deactivateReasonService->all();
        return view('admin.deactivatereason.deactivateReasons',$data);
    }
    public function create(Request $request){
        $data['title'] = "Deactivate Reason";
        $data['page']  = "Deactivate Reason List";
        $validator = Validator::make($request->all(),[
            "content" => "required",
        ]);
        if($validator->fails()){
            return response()->json([
                "error" => true,
                ",msg" => $validator->fails()
            ],422);
        }
       $data['list'] =  $this->deactivateReasonService->createOrUpdate($request->all());
       return 1;
       return view('admin.deactivatereason.deactivateReasons',$data);
    }

    public function delete(Request $request) {
        $this->deactivateReasonService->delete($request->id);
        return 1;
    }
}
