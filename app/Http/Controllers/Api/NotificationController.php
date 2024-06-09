<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\NotificationService;

class NotificationController extends Controller
{
    private $notificationService;
    public function __construct(NotificationService $notificationService) {
        $this->notificationService = $notificationService;
    }

    public function list() {
        return response()->json(['status' => 1,'message' => trans('message.SUCCESS'), 'response' => $this->notificationService->userNotifications(auth()->user()->id)->getCollection()], 200);
    }
}
