<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\PolicyService;
use App\Http\Controllers\Controller;
use App\Services\StaticPagesService;

class PrivacyPolicyController extends Controller
{
    private $policyService;
    public function __construct(StaticPagesService $policyService)
    {
        $this->policyService = $policyService;
    }
    public function index() {
        $data['list'] =  $this->policyService->getContentByType('policy');
        $data['page'] = "Privacy Policy";
        $data['title'] = "Privacy Policy";
        return view('admin/policy/policy', $data);
    }
    public function updatePolicy(Request $request) {
        $this->policyService->update('policy',['title' => $request->header,'content' => $request->content]);
        return redirect('admin/privacy_policy');
    }
    public function terms() {
        $data['list'] =  $this->policyService->getContentByType('terms');
        $data['page'] = "Terms & Conditions";
        $data['title'] = "Terms & Conditions";
        return view('admin/policy/terms', $data);
    }
    public function updateTerms(Request $request) {
         $data= $this->policyService->update('terms',['title' => $request->header,'content' => $request->content]);
        return redirect('admin/terms_condition');
    }
}
