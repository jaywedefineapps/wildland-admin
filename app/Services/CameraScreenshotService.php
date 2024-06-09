<?php

namespace App\Services;

use App\Models\CameraScreenshot;

class CameraScreenshotService {

    private $cameraScreenshot;
    public function __construct(CameraScreenshot $cameraScreenshot) {
        $this->cameraScreenshot = $cameraScreenshot;
    }

    public function create($data) {
        return $this->cameraScreenshot->create($data);
    }

    public function deleteByChanleNoCameraIdUserId($chNo,$cId,$uId){
        return $this->cameraScreenshot->where('channel_no',$chNo)->where('user_id',$uId)->where('camera_id',$cId)->delete();
    }
    public function getByChanleNoCameraIdUserId($chNo,$cId,$uId){
        return $this->cameraScreenshot->where('channel_no',$chNo)->where('user_id',$uId)->where('camera_id',$cId)->first();
    }
    public function update($id,$data) {
        return $this->cameraScreenshot->where('id',$id)->update($data);
    }

}

?>
