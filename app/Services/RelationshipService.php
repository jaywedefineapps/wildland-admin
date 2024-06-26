<?php

namespace App\Services;

use App\Models\Relationship;

class RelationshipService
{
    private $relationship;
    public function __construct(Relationship $relationship) {
        $this->relationship = $relationship;
    }

    public function all() {
        return $this->relationship->get();
    }

    public function createOrUpdate($data) {
        return $this->relationship->updateORcreate(['id'=>$data['id']],$data);
    }

    public function delete($id) {
        return $this->relationship->find($id)->delete();
    }
}

?>
