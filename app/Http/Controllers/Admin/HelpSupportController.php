<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\HelpSupportsService;
use Illuminate\Http\Request;

class HelpSupportController extends Controller
{
    private $helpSupportService;

    public function __construct(HelpSupportsService $helpSupportService){
        $this->helpSupportService = $helpSupportService;
    }

    public function index(Request $request){
        $data['page'] = "Users Help & Support ";
        $data['title'] = "Users Help & Support";
        $data['list'] = $this->helpSupportService->getByType('user');
        return view('admin.helpsupport.helpsupport', $data);
    }
    public function technicianList(Request $request){
        $data['page'] = "Technician Help & Support ";
        $data['title'] = "Technician Help & Support";
        $data['list'] = $this->helpSupportService->getByType('technician');
        return view('admin.helpsupport.helpsupport', $data);
    }

    public function delete(Request $request){
        $this->helpSupportService->delete($request->id); 
        return 1;
    }

}
