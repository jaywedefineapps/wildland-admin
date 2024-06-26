<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserFirebaseService;
use App\Services\UserService;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    private $userFirebaseService;
    private $userService;
    public function __construct(UserFirebaseService $userFirebaseService, UserService $userService)
    {
        $this->userFirebaseService = $userFirebaseService;
        $this->userService = $userService;
    }

    public function register(Request $request)
    {
     
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required|min:6',
            'phone' => [
                'required',
                Rule::unique('users')->where(function (Builder $query) use ($request) {
                    return $query->where('phone', $request->phone)->where('country_code', $request->countryCode);
                })->whereNull('deleted_at'),
            ],
          
            'email' => ['required', Rule::unique('users', 'email')->whereNull('deleted_at')],
            'address' => 'required',
            'zipcode' => 'required',
            'firebaseToken' => 'required',
            'platform' => 'required',
            'countryCode' => 'required',
        ], [
         
            'email.unique' => trans('message.EMAIL_ALREADY_EXIST'),
            'phone.unique' => trans('message.PHONE_ALREADY_EXIST'),
            'password.min' => trans('message.PASS_MIN'),
        ]);       

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => $validator->messages()->first()], 200);
        }

        $user = $this->userService->create(array_merge($request->all(), ['country_code' => $request->countryCode,'type'=>'user']));

        if ($request->hasfile('image')) {
            $image = mediaUpload('user_profile', $request->file('image'));
            $this->userService->update($user['id'], ['image' => $image]);
        }

        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json(['success' => false, 'message' => 'invalid Email or Password!']);
        } else {
            $token = auth()->user()->createToken('Token')->accessToken;
            $user = auth()->user();
            $response['token'] = $token;
            $response['id'] = $user['id'];
            $response['email'] = $user['email'];
            $response['name'] = $user['name'];
            $response['profile_image'] = $user['profile_image'];
            $response['phone'] = $user['phone'];
            $response['countryCode'] = $user['country_code'];
            $response['address'] = $user['address'];
            $response['zipcode'] = $user['zipcode'];
            $response['type'] = $user['type'];
            $response['notification'] = $user['notification'];
           
            return response()->json(['status' => 1, 'message' => 'Successfully Registered', 'response' => $response], 200);
            
        }
    }
    public function addFamilyMember(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'relationship_id' => 'required',
            'password' => 'required|min:6',
            'email' => ['required', Rule::unique('users', 'email')->whereNull('deleted_at')],
            'phone' => [
                'required',
                Rule::unique('users')->where(function (Builder $query) use ($request) {
                    return $query->where('phone', $request->phone)->where('country_code', $request->countryCode);
                })->whereNull('deleted_at'),
            ],
            'countryCode' => 'required',
        ], [
            'phone.unique' => trans('message.PHONE_ALREADY_EXIST'),
            'email.unique' => trans('message.EMAIL_ALREADY_EXIST'),
            'password.min' => trans('message.PASS_MIN'),
        ]);       

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => $validator->messages()->first()], 200);
        }

        $user = $this->userService->create(array_merge($request->all(), ['country_code' => $request->countryCode,'type'=>'user','relationship_type'=>'child','parent_id'=>auth()->user()->id,]));

        if ($request->hasfile('image')) {
            $image = mediaUpload('user_profile', $request->file('image'));
            $this->userService->update($user['id'], ['image' => $image]);
        }

        //send the email to new added user with login credantioals
        //===
        return response()->json(['status' => 1, 'message' => 'Successfully Added'], 200);
    }

    public function editFamilyMember(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'userId'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => trans('message.ALL_FIELDS_REQUIRED')], 200);
        }
        $user = $this->userService->find($request->userId);
        if ($request->hasfile('image')) {
            unlinkFile('assets/user_profile/'.$user->image);
            $image = mediaUpload('user_profile', $request->file('image'));
        } else {
            $image = $user->image ?? null;
        }

        $this->userService->update($request->userId, ['image' => $image, 'name' => $request->name,'relationship_id'=>$request->relationship_id]);
        return response()->json(['status' => 1, 'message' => trans('message.SUCCESSFULLY_UPDATED')], 200);
    }
    public function deleteFamilyMember(Request $request){
        $validator = Validator::make($request->all(), [
            'userId'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => trans('message.ALL_FIELDS_REQUIRED')], 200);
        }

        $this->userService->delete($request->userId);
        return response()->json(['status' => 1, 'message' => trans('message.SUCCESSFULLY_DELETED')], 200);
    }
    public function getFamilyMember(Request $request){
        $response = $this->userService->getByParentId(auth()->user()->id);
        return response()->json(['status' => 1, 'message' => trans('message.SUCCESS'), 'response' => $response], 200);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required|min:6',
            'firebaseToken' => 'required',
            'platform' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => $validator->errors()->first()], 200); //'message' => trans('message.ALL_FIELDS_REQUIRED')],
        }

        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required|min:6',
        ]);

      

        if (!auth()->attempt($data)) {
            $user = get_row_by_id($request->email, 'users', 'email');
            if (empty($user)) {
                return response()->json(['status' => 0, 'message' => trans('message.INVALID_EMAIL_ADDRESS')], 200);
            } else if ($user->deleted_at !== null) {
                return response()->json(['status' => 0, 'message' => trans('message.ACCOUNT_DELETED')], 200);
            }
            return response()->json(['status' => 0, 'message' => trans('message.INVALID_PASSWORD')], 200);
        } else {
            $this->userFirebaseService->deletFcm($request->firebaseToken);

            $token = auth()->user()->createToken('Token')->accessToken;
         
            $user = auth()->user();
            $response['token'] = $token;
            $response['id'] = $user['id'];
            $response['email'] = $user['email'];
            $response['name'] = $user['name'];
            $response['profile_image'] = $user['profile_image'];
            $response['phone'] = $user['phone'];
            $response['country_code'] = $user['country_code'];
            $response['address'] = $user['address'];
            $response['zipcode'] = $user['zipcode'];
            $response['type'] = $user['type'];
            $response['relationship_type'] = $user['relationship_type'];
            $response['notification'] = $user['notification'];
            $response['fcmId'] = $this->userFirebaseService->create(['user_id' => $user['id'], 'fcm_token' => $request->firebaseToken, 'platform' => $request->platform])->id;

            return response()->json(['status' => 1, 'message' => trans('message.SUCCESS_LOGIN'), 'response' => $response], 200);
        }
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => $validator->errors()->first()], 200);
        }

        $this->userService->updatePassword($request->email, $request->password);
        $user = $this->userService->getByEmail($request->email);
        return response()->json(['status' => 1, 'message' => trans('message.PASSWORD_CHANGED')], 200);
    }


    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => trans('message.ALL_FIELDS_REQUIRED')], 200);
        }

        $user = auth()->user();

        if (Hash::check($request->oldPassword, $user->password)) {
            $this->userService->update($user->id, ['password' => $request->newPassword]);
            return response()->json(['status' => 1, 'message' => trans('message.PASSWORD_CHANGED')], 200);
        } else {
            return response()->json(['status' => 0, 'message' => trans('message.WRONG_OLD_PASSWORD')], 200);
        }
    }
    public function getProfile()
    {
        if (auth()->check()) {
            $id = auth()->user()->id;
        }

        $response = $this->userService->find($id);

        return response()->json(['status' => 1, 'message' => 'Success', 'response' => $response], 200);
    }
    public function logout(Request $request)
    {
        if (Auth::check()) {
            if (!empty($request->firebaseToken)) {
                $this->userFirebaseService->delete($request->firebaseToken);
            }
            Auth::user()->token()->delete();
            return response()->json(['status' => 1, 'message' => trans('message.LOGGED_OUT')], 200);
        } else {
            return response()->json(['status' => 0, 'message' => trans('message.TOKEN_EXPIRE')], 401);
        }
    }
    public function profileUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => trans('message.ALL_FIELDS_REQUIRED')], 200);
        }

        if ($request->hasfile('image')) {
            unlinkFile('assets/user_profile/'.auth()->user()->image);
            $image = mediaUpload('user_profile', $request->file('image'));
        } else {
            $image = auth()->user()->image;
        }

        $this->userService->update(auth()->user()->id, ['image' => $image, 'name' => $request->name]);
        return response()->json(['status' => 1, 'message' => trans('message.SUCCESSFULLY_UPDATED')], 200);
    }
}
