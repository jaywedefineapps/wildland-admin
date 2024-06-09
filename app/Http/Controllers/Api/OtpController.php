<?php

namespace App\Http\Controllers\Api;

use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\OTP;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Validator;

class OtpController extends Controller
{
    private $otpService;
    public function __construct(OtpService $otpService) {
        $this->otpService = $otpService;
    }

    public function sendOtp(Request $request) {
        $validator = Validator::make($request->all(),[
            'type' => 'required|in:userVerification,forgotPassword',
        ]);
        if($request->type == "userVerification"){
            $validator = Validator::make($request->all(),[
                'phone' => [
                    'required',
                    Rule::unique('users')->where(function (Builder $query) use($request) {
                        return $query->where('phone', $request->phone)->where('country_code',$request->countryCode);
                    }),
                ],
                'countryCode' => 'required',
                // 'email' => 'required|unique:users,email',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users')->where(function ($query) {
                        $query->whereNull('deleted_at');
                    }),
                ],
            ]);
        } else if($request->type == "forgotPassword") {
            $validator = Validator::make($request->all(),[
                'email' => 'required|exists:users,email',
            ]);
        }
        if($validator->fails()) {
            // return response()->json(['status' => 0, 'message' => $validator->messages()->first()], 200);
            return response()->json(['status' => 0, 'message' => trans('message.THE_SELECTED_EMAIL_IS_INVALID')], 200);

        }
        $otp = 1111;
        if($request->type == "forgotPassword") {
            $this->otpService->deleteIfExist($request->email);
        }else{
            $this->otpService->deleteIfExistPhone($request->phone);
        }

        $this->otpService->create(['verification_type' => $request->type, 'email' => $request->email,'phone' => $request->phone, 'user_type' => 'user', 'otp' => $otp]);
        return response()->json(['status' => 1,'message' => trans('message.OTP_SENT_SUCCESSFULLY')], 200);
    }

    public function verifyOtp(Request $request) {

        $validator = Validator::make($request->all(),[
            'type' => 'required|in:userVerification,forgotPassword',
        ]);
        if($request->type == "userVerification"){
            $validator = Validator::make($request->all(),[
                'phone' => 'required',
            ]);
        }else if($request->type == "forgotPassword"){
            $validator = Validator::make($request->all(),[
                'email' => 'required',
            ]);
        }

        if($validator->fails()) {

            return response()->json(['status' => 0, 'message' => trans('message.ALL_FIELDS_REQUIRED')], 200);
        }
        if($request->type == "userVerification"){
            $verification = $this->otpService->verifyOtpPhone($request->phone,$request->otp,$request->type,'user');
        }
        else{
            $verification = $this->otpService->verifyOtpEmail($request->email,$request->otp,$request->type,'user');
        }
        // return $verification;
        if(!empty($verification)) {
            $this->otpService->deleteIfExist($request->email);
            $this->otpService->deleteIfExistPhone($request->phone);
            return response()->json(['status' => 1,'message' => trans('message.OTP_VERIFIED')], 200);
        }else {
            return response()->json(['status' => 0,'message' => trans('message.WRONG_OTP')], 200);
        }
    }
}
