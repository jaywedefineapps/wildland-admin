<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private $settingService;
    public function __construct(SettingService $settingService) {
        $this->settingService = $settingService;
    }

    public function index() {
        $data['page'] = "Settings";
        $data['title'] = "Settings";
        $data['setting'] = $this->settingService->get();
        return view('admin.setting.setting',$data);
    }

    public function update(Request $request) {
        if ($request->isMethod('POST')) {
        $this->settingService->update($request->all());
        return redirect()->back()->with('success', 'Settings Updated!!');
    }
    return redirect()->route('admin.dashboard');
    }
    public function changeTaxSetting(Request $request) {
        $type = $request->taxSetting;
        $this->settingService->updateTax(['tax_type' => $type]);
        return 1;
    }
}
