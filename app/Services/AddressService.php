<?php

namespace App\Services;

use App\Models\Address;

class AddressService {

    private $address;
    public function __construct(Address $address) {
        $this->address = $address;
    }

    public function create($data) {
        return $this->address->create($data);
    }

    public function userAddresses($id) {
        return $this->address->select('address.*','countries.name as countryName','provinces.name as provinceName','cities.name as cityName')->join('countries','address.country_id','=','countries.id')->join('provinces','address.province_id','=','provinces.id')->join('cities','address.city_id','=','cities.id')->where('user_id',$id)->paginate();
    }
    public function userAddressesAll($id) {
        return $this->address->select('address.*','countries.name as countryName','provinces.name as provinceName','cities.name as cityName')->join('countries','address.country_id','=','countries.id')->join('provinces','address.province_id','=','provinces.id')->join('cities','address.city_id','=','cities.id')->where('user_id',$id)->get();
    }

    public function getUserAllAddress($userId){
        return $this->address->where('user_id','=',$userId)->get();
    }

    public function removeDefaultAddress($userId) {
        return $this->address->withTrashed()->where('user_id',$userId)->update(['is_default'=>'0']);
    }

    public function setDefaultAddress($addressId) {
        return $this->address->where('id',$addressId)->update(['is_default'=>'1']);
    }

    public function getDefaultAddress($userId) {
        return $this->address->where('user_id',$userId)->where('is_default','1')->first();
    }

    public function delete($id) {
        return $this->address->find($id)->delete();
    }

    public function update($id,$data) {
        return $this->address->find($id)->update($data);
    }

    public function find($id) {
        return $this->address->find($id);
    }
    public function createOrUpdate($data) {
        return $this->address->updateORcreate(['id'=>$data['id']],$data);
    }
}

?>
