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

    public function userFaq(){
        $data['type'] = 'user';
        $data['title'] = "User Frequenlty Asked Questions";
        $data['page'] = "User Frequenlty Asked Questions List";
        $data['list'] = $this->faqService->getByType('user');
        return view('admin.faq.faq',$data);
    }
    public function technicianFaq(){
        $data['type'] = 'technician';
        $data['title'] = "Technician Frequenlty Asked Questions";
        $data['page'] = "Technician Frequenlty Asked Questions List";
        $data['list'] = $this->faqService->getByType('technician');
        return view('admin.faq.faq',$data);
    }

  
    public function create(Request $request){
        $data['title'] = "Frequenlty Asked Questions";
        $data['page']  = "Frequenlty Asked Questions List";
        $validator = Validator::make($request->all(),[
            "question" => "required",
            'answer' => "required",
            'type' => "required",
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
