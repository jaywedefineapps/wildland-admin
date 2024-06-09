<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\FaqService;
use Illuminate\Support\Facades\Validator;

class FAQController extends Controller
{
    private $faqService;
    public function __construct(FaqService $faqService)
    {
        $this->faqService = $faqService;
    }

    public function index(){
        $data['type'] = 'user';
        $data['title'] = "Frequenlty Asked Questions";
        $data['page'] = "Frequenlty Asked Questions List";
        $data['list'] = $this->faqService->get();
        return view('admin.faq.faq',$data);
    }

  
    public function create(Request $request){
        $data['title'] = "Frequenlty Asked Questions";
        $data['page']  = "Frequenlty Asked Questions List";
        $validator = Validator::make($request->all(),[
            "question" => "required",
            'answer' => "required",
        ]);
        if($validator->fails()){
            return response()->json([
                "error" => true,
                ",msg" => $validator->fails()
            ],422);
        }

        $data['list'] =  $this->faqService->createOrUpdate($request->all());
        return 1;
        return view('admin.faq.faq',$data);
    }

    public function delete(Request $request) {
        $this->faqService->delete($request->id);
        return 1;
    }
}
