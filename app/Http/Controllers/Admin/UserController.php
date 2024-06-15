<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Validation\Rule;
use App\Services\AddressService;
use App\Services\CountryService;
use App\Models\DeactivateReasons;
use App\Services\UserValveService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $userService;
    private $countryService;
    private $userValveService;
    private $addressService;
    public function __construct(UserService $userService, CountryService $countryService,UserValveService $userValveService,AddressService $addressService)
    {
        $this->userService = $userService;
        $this->countryService = $countryService;
        $this->userValveService = $userValveService;
        $this->addressService = $addressService;
    }

    public function deletedAt(Request $request){
        $id = $request->id;
        $this->userService->delete($id);
        return 1;
    }
    public function deletedValve(Request $request){
        $id = $request->id;
        $this->userValveService->delete($id);
        return 1;
    }
    public function isVisible(Request $request){
        $id = $request->id;
        $is_visible = $request->is_visible;
        $valve = $this->userValveService->find($id);
        $newVisibility = $valve->is_visible ? 0 : 1;
        $valve->is_visible = $newVisibility;
        $this->userValveService->update($id,['is_visible' => $is_visible]);
        $valve->save();
        return 1;
    }
    public function addValve(Request $request){
        $validator = Validator::make($request->all(),[
            'valve_api_key' => 'required',
            'address_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'msg' => $validator->errors(),
            ], 422);
        }
        $this->userValveService->deleteByUidAndKey($request->user_id,$request->valve_api_key);
        $this->userValveService->createOrUpdate(['id'=>$request->id,'user_id'=>$request->user_id,'valve_api_key'=>$request->valve_api_key,'address_id'=>$request->address_id]);
        return 1;
    }

    public function restorUser(Request $request){
        $id = $request->id;
        $this->userService->restorUser($id);
        return 0;
    }

    public function verified(Request $request){
        if ($request->deactivate_reasons) {
            $cus = $request->deactivate_reasons;
            if ($cus == "cus") {
                $validator = Validator::make($request->all(), [
                    'deactivate_reasons_cutoms' => 'required',
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'error' => true,
                        'msg' => $validator->errors(),
                    ], 422);
                }
                $deactive_reasons = $request->deactivate_reasons_cutoms;
            } else {
                $validator = Validator::make($request->all(), [
                    'deactivate_reasons' => 'required',
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'error' => true,
                        'msg' => $validator->errors(),
                    ], 422);
                }

                $deactive_reasons = $request->deactivate_reasons;
            }
            $this->userService->update($request->id, ['deactive_reasons' => $deactive_reasons, 'verified' => $request->status, 'deleted_at' => Carbon::now()]);
            return 1;
        } else {
            $this->userService->update($request->id, ['verified' => $request->status, 'deactive_reasons' => '']);
            return 1;
        }

    }

    public function active(Request $request){
        $data['page'] = "Users";
        $data['title'] = "User Active Listing";
        $data['list'] = $this->userService->activeUsers($request);
        $data['type'] = "users";
        $data['deactivereason'] = DeactivateReasons::all();
        return view('admin.users.activeuser', $data);
    }

    public function banned(Request $request){
        $data['page'] = "Users";
        $data['title'] = "User Banned Listing";
        $data['list'] = $this->userService->bannedUser($request);
        $data['deactivereason'] = DeactivateReasons::all();
        $data['type'] = "users";
        return view('admin.users.banned', $data);
    }
    public function activeTechnician(Request $request){
        $data['page'] = "Technician";
        $data['title'] = "Technician Active Listing";
        $data['list'] = $this->userService->activeTechnician($request);
        $data['type'] = "technician";
        $data['deactivereason'] = DeactivateReasons::all();
        return view('admin.users.activeuser', $data);
    }

    public function bannedTechnician(Request $request){
        $data['page'] = "Technician";
        $data['title'] = "Technician Banned Listing";
        $data['list'] = $this->userService->bannedTechnician($request);
        $data['deactivereason'] = DeactivateReasons::all();
        $data['type'] = "technician";
        return view('admin.users.banned', $data);
    }

    public function getEdit(Request $request){
        $data['page'] = "Users";
        $data['title'] = "Users Edit";
        $data['list'] = $this->userService->find($request->id);
        $data['countries'] = $this->countryService->all();
        $data['type'] = "Users";
        return view('admin.users.edit', $data);
    }
    public function getTechnicianEdit(Request $request){
        $data['page'] = "Technician";
        $data['title'] = "Technician Edit";
        $data['list'] = $this->userService->find($request->id);
        $data['countries'] = $this->countryService->all();
        $data['type'] = "Users";
        return view('admin.users.edit-technician', $data);
    }

    public function postEdit(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'country_code' => 'required',
            'phone' => 'required|min:10',
        ]);
        $userId = $request->id;
        if ($request->hiddenEmail != '') {
            $validator = Validator::make($request->all(), [
                'email' => [
                    'required',
                    Rule::unique('users')->where(function ($query) use ($userId) {
                        return $query->where('id', '!=', $userId);
                    }),
                ],
            ]);
        }
        if ($request->hiddenPhone != '') {
            $validator = Validator::make($request->all(), [
                'phone' => [
                    'required',
                    Rule::unique('users')->where(function (Builder $query) use ($request, $userId) {
                        return $query->where('phone', $request->phone)
                                     ->where('country_code', $request->country_code)
                                     ->whereNull('deleted_at')
                                     ->where('id', '!=', $userId); // Exclude the current user's ID
                    }),
                ],
            ]);
        }

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->errors());
        }
        if ($request->hasFile('image')) {
            $imageName = mediaUploadAzure('user_profile', $request->file('image'));
        
        } elseif (isBase64Image($request->hidden_base64_input)) {           
            $base64data = $request->input('hidden_base64_input');
            $imageName = mediaUploadAzure('user_profile', $base64data, 'base64');
        
        } else {
            $imageName = $request->old_image;
        }
        if($request->id){
            $request->merge(['verified'=>$request->verified]);
        }else{
            $request->merge(['verified'=>1]);
        }
        $request->merge(['image'=> $imageName]);
        $requestData = $request->all();
         $this->userService->createOrUpdate($requestData);
        if($request->type == 'user'){
            return redirect()->route('user.active')->with('success', 'Success !!');
        }else{
            return redirect()->route('technician.active')->with('success', 'Success !!');
        }
    }

    public function addUsers(Request $request){
        $data['page'] = "Users";
        $data['title'] = "Users Add";
        $data['list'] = $this->userService->find($request->id);
        $data['countries'] = $this->countryService->all();
        $data['type'] = "Users";
        return view('admin.users.add', $data);
    }
    public function addTechnician(Request $request){
        $data['page'] = "Technician";
        $data['title'] = "Technician Add";
        $data['list'] = $this->userService->find($request->id);
        $data['countries'] = $this->countryService->all();
        $data['type'] = "technician";
        return view('admin.users.add-technician', $data);
    }

    public function userValve(Request $request){
        $data['page'] = "User Valve";
        $data['title'] = "User Valve";
        $data['list'] = $this->userValveService->getByUserIds($request->id);
        $data['address'] = $this->addressService->getUserAllAddress($request->id);
        $data['type'] = "user";
        return view('admin.users.valve', $data);
    }
    public function baseStationDetails(Request $request){
        $data['page'] = "Base Station Details";
        $data['title'] = "Base Station Details";

        $headers = [
            'Authorization' => 'Bearer '.$request->id,
        ];
        $personId =  Http::withHeaders($headers)->get('https://api.rach.io/1/public/person/info');
        if($personId->getStatusCode() == 401){
            return redirect()->back()->with('error',$personId->json()['errors'][0]['message']);
        }else if($personId->getStatusCode() == 500){
            return redirect()->back()->with('error','something went wrong');
        }
        $personInfo =  Http::withHeaders($headers)->get('https://api.rach.io/1/public/person/'.$personId->json()['id']);
        $data['personDetials'] = $personInfo->json();
        $baseStation =  Http::withHeaders($headers)->get('https://cloud-rest.rach.io/valve/listBaseStations/'.$personId->json()['id']);
        // dd($baseStation->json());
        $data['baseStation'] = $baseStation->json();
        $data['token'] = $request->id;
        return view('admin.users.basestationdetails', $data);
    }
    public function valveList(Request $request){
        // dd($request->id);
        $data['page'] = "Valve List";
        $data['title'] = "Valve List";

        $headers = [
            'Authorization' => 'Bearer '.decrypt($request->token),
        ];

        $valveList =  Http::withHeaders($headers)->get('https://cloud-rest.rach.io/valve/listValves/'.$request->id);
        if($valveList->getStatusCode() == 401){
            return redirect()->back()->with('error',$valveList->json()['errors'][0]['message']);
        }
        if($valveList->getStatusCode() == 403){
            return redirect()->back()->with('error',$valveList->json()['message']);
        }
        $data['valveList'] = $valveList->json();

        return view('admin.users.valvelist', $data);

    }
}
