<?php

namespace App\Services;

use App\Models\City;

class CityService
{
    private $city;
    public function __construct(City $city) {
        $this->city = $city;
    }

    public function all() {
        return $this->city->get();
    }

    public function createOrUpdate($data) {
        return $this->city->updateORcreate(['id'=>$data['id']],$data);
    }

    public function delete($id) {
        return $this->city->find($id)->delete();
    }

    public function getBYProvince($provinceId) {
        return $this->city->where('province_id',$provinceId)->get();
    }

    public function whereInId($array){
        return $this->city->whereIn('id',$array)->get();

    }
}

?>
