<?php

namespace App\Services;
use App\Models\Admin;

class AdminService{

    private $admin;
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function profileUpdate($id,$data){
        return $this->admin->where('id',$id)->update($data);
    }

}
