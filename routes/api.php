<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ActiveFireController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Api\OtpController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\GeneralController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\CameraScreenshotController;
use App\Http\Controllers\Api\UserCameraController;
use App\Http\Controllers\Api\UserValveController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/send-notification', function () {
    Artisan::call('queue:work --stop-when-empty');
    return true;
});

Route::get('unauthorized', function () {
    return response()->json(['status' => 0, 'message' => trans('message.TOKEN_EXPIRE')], 401);
})->name('unauthorized');

Route::controller(OtpController::class)->group(function () {
    Route::post('/sendOtp', 'sendOtp');
    Route::post('/verifyOtp', 'verifyOtp');
});
Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post("resetPassword", 'resetPassword');
    Route::post('logout', 'logout');
});

Route::controller(CountryController::class)->group(function () {
    Route::post('/countries', 'index');
});

Route::middleware('auth:api')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('logout', 'logout');
        Route::post('profileUpdate', 'profileUpdate');
        Route::post('deleteAccount', 'deleteAccount');
        Route::post("changePassword", 'changePassword');
        Route::post("getProfile", 'getProfile');
    });
    Route::controller(AddressController::class)->group(function () {
        Route::post('/addresses', 'userAddresses');
        Route::post('/manageAddress', 'manage');
    });
    Route::controller(UserCameraController::class)->group(function () {
        Route::post('/createCamera', 'createCamera');
        Route::post('/listUserCameras', 'list');
        Route::post('/deleteCamera', 'delete');
        Route::post('/cameraDetails', 'details');
        Route::post('/checkCameraExist', 'checkCameraExist');
    });
    Route::controller(CameraScreenshotController::class)->group(function () {
        Route::post('/createCameraScreenshot', 'create');
    });
    Route::controller(GeneralController::class)->group(function () {
        Route::post('/staticPages', 'staticPages');
        Route::post('/getAppSettings', 'appSettings');
        Route::post('/faq', 'faq');
    });
    Route::controller(UserValveController::class)->group(function () {
        Route::post('/creteValveKey', 'create');
    });

});

Route::controller(ActiveFireController::class)->group(function () {
    Route::get('/setTableData', 'setTableData');
    Route::post('/getActiveFireData','getActiveFireData');
});
