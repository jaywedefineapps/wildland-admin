<?php

namespace App\Services;

use App\Models\Access;

class AccessService{

    private $access;
    public function __construct(Access $access)
    {
        return $this->access = $access;
    }
    public function all(){
    return $this->access->latest('created_at')->get();
    }
    public function createOrUpdate($data){
    return  $this->access->updateORcreate(['id'=>$data['id']],$data);
    }
    public function delete($id) {
        return $this->access->find($id)->delete();
    }
}
