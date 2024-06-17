<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\FaqService;
use Illuminate\Http\Request;
use App\Services\StaticPagesService;
use App\Services\UserValveService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class GeneralController extends Controller
{
    private $staticPageService;
    private $faqService;
    private $userValveService;
    public function __construct(StaticPagesService $staticPageService,FaqService $faqService,UserValveService $userValveService)
    {
        $this->staticPageService = $staticPageService;
        $this->userValveService = $userValveService;
        $this->faqService = $faqService;
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

}
