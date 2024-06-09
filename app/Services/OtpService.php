<?php

namespace App\Services;

use App\Models\OTP;

class OtpService
{
    private $otp;
    public function __construct(OTP $otp) {
        $this->otp = $otp;
    }

    public function create($data) {
        return $this->otp->create($data);
    }

    public function deleteIfExist($email) {
        return $this->otp->where('email',$email)->delete();
    }
    public function deleteIfExistPhone($email) {
        return $this->otp->where('phone',$email)->delete();
    }

    public function verifyOtpPhone($phone,$otp,$type,$userType) {
        return $this->otp->where('phone',$phone)->where('otp',$otp)->where('verification_type',$type)->where('user_type',$userType)->first();
    }
    public function verifyOtpEmail($email,$otp,$type,$userType) {
        return $this->otp->where('email',$email)->where('otp',$otp)->where('verification_type',$type)->where('user_type',$userType)->first();
    }
}


?>
