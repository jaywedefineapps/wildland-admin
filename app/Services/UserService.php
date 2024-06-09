<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create($data){
        return $this->user->create($data);
    }

    public function createOrUpdate($data) {
        return $this->user->updateORcreate(['id'=>$data['id']],$data);
    }

    public function update($id, $data){
        return $this->user->withTrashed()->find($id)->fill($data)->save();
    }
    public function update1($id, $data){
        return $this->user->find($id)->fill($data)->save();
    }

    public function find($id){
        return $this->user->whereId($id)->first();
    }

    public function updatePassword($email,$password) {
        return $this->user->where('email',$email)->update(['password' => Hash::make($password)]);
    }

    public function getByEmail($email) {
        return $this->user->where('email',$email)->first();
    }

    public function delete($id){
        $user = $this->user->find($id);
        return $user->delete();
    }

    public function restorUser($id){
        $post =  $this->user->withTrashed()->find($id);
        $post->update(['deactive_reasons' => null]);
        $post->restore();
    }

    public function activeUsers($data){
        $query = $this->user->newQuery();
        if ($data->input('verified') !== null && $data->input('verified') !== '') {
            $query->where('verified', $data->input('verified'));
        }
        if ($data->input('query') !== null && $data->input('query') !== '') {
            $searchTerm = "%" . $data->input('query') . "%";
            $query->where(function($subQuery) use ($searchTerm) {
                $subQuery->where('name', 'LIKE', $searchTerm)
                         ->orWhere('email', 'LIKE', $searchTerm);
            });
        }
        return $query->where('type','user')->latest()->paginate();
    }

    public function bannedUser($data){
        if($data->input('query')){
            return $this->user
            ->where(function($query) use ($data) {
                $searchTerm = "%" . $data->input('query') . "%";
                $query->where('name', 'LIKE', $searchTerm)
                      ->orWhere('email', 'LIKE', $searchTerm);
            })
            ->onlyTrashed()
            ->paginate();
        }else{
             return $this->user->where('type','user')->onlyTrashed()->paginate();
        }
    }
    public function activeTechnician($data){
        $query = $this->user->newQuery();
        if ($data->input('verified') !== null && $data->input('verified') !== '') {
            $query->where('verified', $data->input('verified'));
        }
        if ($data->input('query') !== null && $data->input('query') !== '') {
            $searchTerm = "%" . $data->input('query') . "%";
            $query->where(function($subQuery) use ($searchTerm) {
                $subQuery->where('name', 'LIKE', $searchTerm)
                         ->orWhere('email', 'LIKE', $searchTerm);
            });
        }
        return $query->where('type','technician')->latest()->paginate();
    }

    public function bannedTechnician($data){
        if($data->input('query')){
            return $this->user
            ->where(function($query) use ($data) {
                $searchTerm = "%" . $data->input('query') . "%";
                $query->where('name', 'LIKE', $searchTerm)
                      ->orWhere('email', 'LIKE', $searchTerm);
            })
            ->onlyTrashed()
            ->paginate();
        }else{
             return $this->user->where('type','technician')->onlyTrashed()->paginate();
        }
    }

    public function deactiveReason($id,$data){
        $vendor = $this->user->withTrashed()->find($id);
        if ($vendor) {
            if ($vendor->trashed()) {
                $vendor->restore();
                $vendor->fill($data)->save();
            } else {
                $vendor->where('id', $id)->update($data);
            }
            return back();
        } else {
            return back();
        }
    }

}
