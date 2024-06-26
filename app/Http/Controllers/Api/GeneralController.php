<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\FaqService;
use Illuminate\Http\Request;
use App\Services\StaticPagesService;
use App\Services\UserValveService;
use Illuminate\Support\Facades\Validator;
use App\Services\HelpSupportsService;
use App\Services\RelationshipService;
use Illuminate\Validation\Rule;

class GeneralController extends Controller
{
    private $staticPageService;
    private $faqService;
    private $HelpSupportService;
    private $userValveService;
    private $relationshipservice;
    public function __construct(StaticPagesService $staticPageService,FaqService $faqService,UserValveService $userValveService,HelpSupportsService $HelpSupportService,RelationshipService $relationshipservice)
    {
        $this->staticPageService = $staticPageService;
        $this->userValveService = $userValveService;
        $this->relationshipservice = $relationshipservice;
        $this->faqService = $faqService;
        $this->HelpSupportService = $HelpSupportService;
    }
    public function staticPages(Request $request)
    {
        $validator = Validator::make($request->all(), ['type' => ['required', Rule::in(['policy', 'terms'])]]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => trans('message.TYPE_SHOULD_BE_TERMS_OR_POLICY')], 200);
        }

        $staticContent = $this->staticPageService->getContentByType($request->type);
        $response['title'] = $staticContent->title;
        $response['content'] = $staticContent->content;

        return response()->json(['status' => 1, 'message' => trans('message.SUCCESS'), 'response' => $response], 200);
    }

    public function faq(Request $request){
        $validator = Validator::make($request->all(), ['type' => ['required', Rule::in(['user', 'technician'])]]);

        if($validator->fails()) {
            return response()->json(['status' => 0, 'message' => $validator->messages()->first()], 200);
        }
        $response = $this->faqService->getByType($request->type);
        return response()->json(['status' => 1, 'message' => trans('message.SUCCESS'), 'response' => $response], 200);
    }
    public function getRelationship(Request $request){
        $response = $this->relationshipservice->all();
        return response()->json(['status' => 1, 'message' => trans('message.SUCCESS'), 'response' => $response], 200);
    }
    public function appSettings(Request $request){
        $response = array();
        if (auth('api')->check()) {
            $valveApiKey = $this->userValveService->getByUserId(auth()->user()->id);
            if (!empty($valveApiKey)) {
                $response['valve_api_key']= $valveApiKey->valve_api_key;
            } else {
                $response['valve_api_key']= '';
            }
        }
        return response()->json(['status' => 1, 'message' => trans('message.SUCCESS'), 'response' => $response], 200);
    }
    public function helpSupport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'message' => 'required',
            'type'=>'required'
        ]);

        if($validator->fails()) {
            return response()->json(['status' => 0, 'message' => $validator->messages()->first()], 200);
        }

        $this->HelpSupportService->create(['email' => $request->email, 'message' => $request->message,'type'=>$request->type, 'user_id' => auth()->user()->id]);
        return response()->json(['status' => 1, 'message' => 'Successfully send'], 200);
    }

}
