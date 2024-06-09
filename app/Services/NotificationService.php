<?php

namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    private $notification;
    public function __construct(Notification $notification) {
        $this->notification = $notification;
    }

    public function create($data) {
        $this->notification->create($data);
    }

    public function userNotifications($id) {
        return $this->notification->where('user_id',$id)->latest()->paginate(10);
    }
}
