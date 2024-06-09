<?php

namespace App\Services;

use App\Models\Province;

class ProvinceService
{
    private $province;
    public function __construct(Province $province) {
        $this->province = $province;
    }

    public function all() {
        return $this->province->get();
    }

    public function createOrUpdate($data) {
        return $this->province->updateORcreate(['id'=>$data['id']],$data);
    }

    public function delete($id) {
        return $this->province->find($id)->delete();
    }

    public function getByCountry($countryId) {
        return $this->province->where('country_id',$countryId)->get();
    }
}

?>
