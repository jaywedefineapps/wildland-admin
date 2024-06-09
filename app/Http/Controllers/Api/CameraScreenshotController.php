<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CameraScreenshotService;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CameraScreenshotController extends Controller
{
    private $camerassService;
    public function __construct(CameraScreenshotService $camerassService) {
        $this->camerassService = $camerassService;
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'cameraId' => 'required',
            'image' => 'required',
            'channelNo' => 'required',
        ]);
        if($validator->fails()) {
            return response()->json(['status' => 0, 'message' => $validator->messages()->first()], 200);
        }
        // $imgName = '';
        // if ($request->hasfile('image')) {
        //     $imgName = mediaUpload('camera_screenshot', $request->file('image'));
        // }

        $camerass = $this->camerassService->getByChanleNoCameraIdUserId($request->channelNo,$request->cameraId,auth()->user()->id);

        if($camerass->image != null) {
            unlinkFile('assets/camera_screenshot/'.$camerass->image);
        }
        $imgName = '';
        if ($request->hasfile('image')) {
            $imgName = mediaUpload('camera_screenshot', $request->file('image'));
        }
        $this->camerassService->update($camerass->id,['image'=>$imgName]);
        return response()->json(['status' => 1,'message' => trans('message.SUCCESS')], 200);
    }
}
