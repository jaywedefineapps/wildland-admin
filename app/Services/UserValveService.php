<?php

namespace App\Services;


use App\Models\UserValve;

class UserValveService
{
    private $userValve;
    public function __construct(UserValve $userValve) {
        $this->userValve = $userValve;
    }

    public function create($data) {
        return $this->userValve->create($data);
    }
    public function getByUserId($id) {
        return $this->userValve->where('user_id',$id)->first();
    }
    public function getByUserIds($id) {
        return $this->userValve->where('user_id',$id)->with('addressData')->paginate();
    }
    public function deleteByUidAndKey($uId,$key){
        return $this->userValve->where('valve_api_key',$key)->where('user_id',$uId)->delete();
    }
    public function delete($id){
        $user = $this->userValve->find($id);
        return $user->delete();
    }

    public function update($id, $data){
        return $this->userValve->find($id)->fill($data)->save();
    }

    public function find($id){
        return $this->userValve->where('id',$id)->first();
    }
    public function createOrUpdate($data) {
        return $this->userValve->updateORcreate(['id'=>$data['id']],$data);
    }


}
?>