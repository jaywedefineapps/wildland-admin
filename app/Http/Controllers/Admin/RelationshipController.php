<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\RelationshipService;
use Illuminate\Support\Facades\Validator;

class RelationshipController extends Controller
{
    private $relationshipService;
    public function __construct( RelationshipService $relationshipService)
    {
        $this->relationshipService = $relationshipService;
    }

    public function index()
    {
        $data['page'] = "Relationship";
        $data['title'] = "Relationship List";
        $data['list'] = $this->relationshipService->all();
        return view('admin.relationship.list', $data);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:relationship,name,' . $request->id . ',id,deleted_at,NULL',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'msg' => $validator->errors(),
            ], 422);
        }
        $this->relationshipService->createOrUpdate($request->all());
        return 1;
    }

    public function delete(Request $request)
    {
        $this->relationshipService->delete($request->id);
        return 1;
    }
}
