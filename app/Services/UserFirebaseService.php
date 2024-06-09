<?php

namespace App\Services;

use App\Models\UserFirebase;

class UserFirebaseService {

    private $userFirebase;
    public function __construct(UserFirebase $userFirebase) {
        $this->userFirebase = $userFirebase;
    }

    public function create($data) {
        return $this->userFirebase->create($data);
    }

    public function deletFcm($token) {
        return $this->userFirebase->where('fcm_token',$token)->delete();
    }

    public function delete($id) {
        $data = $this->userFirebase->find($id);
        if(!empty($data)) {
            $this->userFirebase->where('fcm_token',$data->fcm_token)->delete();
        }
        return $this->userFirebase->where('id',$id)->delete();
    }

}
