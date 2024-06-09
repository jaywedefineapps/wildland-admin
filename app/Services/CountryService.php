<?php

namespace App\Services;

use App\Models\Country;

class CountryService
{
    private $country;
    public function __construct(Country $country) {
        $this->country = $country;
    }

    public function all() {
        return $this->country->get();
    }

    public function createOrUpdate($data) {
        return $this->country->updateORcreate(['id'=>$data['id']],$data);
    }

    public function delete($id) {
        return $this->country->find($id)->delete();
    }

    public function removeDefault() {
        return $this->country->withTrashed()->where('default',1)->update(['default' => 0]);
    }

    public function getDefualt(){
        return $this->country->where('default',1)->first();
    }
}

?>
