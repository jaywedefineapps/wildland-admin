<?php

namespace App\Services;

use App\Models\UserCamera;

class UserCameraService
{
    private $userCamera;
    public function __construct(UserCamera $userCamera) {
        $this->userCamera = $userCamera;
    }

    public function create($data) {
        return $this->userCamera->create($data);
    }
    public function delete($id) {
        return $this->userCamera->find($id)->delete();
    }
    public function deleteNew($id) {
        return $this->userCamera->where('id',$id)->delete();
    }

    public function update($id,$data) {
        return $this->userCamera->find($id)->update($data);
    }

    public function find($id) {
        return $this->userCamera->with('cameraScreenshots')->with('address')->find($id);
    }
    public function getByUserId($id) {
        return $this->userCamera->where('user_id',$id)->with('cameraScreenshots')->with('address')->get();
    }
    public function getByIpUidPort($ip,$port,$uid) {
        return $this->userCamera->where('user_id',$uid)->where('ip_address',$ip)->where('port',$port)->get();
    }
    
}


?>