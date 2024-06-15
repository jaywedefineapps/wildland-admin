<?php

namespace App\Services;
use App\Models\TechnicianRequest;

class TechnicianRequestService
{
    private $request;
    public function __construct(TechnicianRequest $request)
    {
        $this->request = $request;
    }
    public function getListByType($status){
        return $this->request->where('status',$status)->with('user')->with('technician')->paginate();
    }
    public function getListType($status){
        return $this->request->where('status',$status)->with('user:name,id,address,zipcode')->with('address')->paginate();
    }
    public function create($data) {
        return $this->request->create($data);
    }
    public function delete($id) {
        return $this->request->find($id)->delete();
    }
    public function deleteNew($id) {
        return $this->request->where('id',$id)->delete();
    }

    public function update($id,$data) {
        return $this->request->find($id)->update($data);
    }
    public function createOrUpdate($data) {
        return $this->request->updateORcreate(['id'=>$data['id']],$data);
    }
}