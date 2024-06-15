<?php
namespace App\Services;

use App\Models\Admin;

class UserRoleService{
    private $admin;
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }
    public function all(){
    return $this->admin->select('*','roles.name as rname','admin.name as aname','admin.id as aid')->join('roles','roles.id','admin.role_id')->latest('admin.created_at')->get();
    }
    public function createOrUpdate($data){
    return  $this->admin->updateORcreate(['id'=>$data['id']],$data);
    }
    public function delete($id) {
        return $this->admin->find($id)->delete();
    }


}
