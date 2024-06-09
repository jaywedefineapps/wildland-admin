<?php

namespace App\Services;

use App\Models\DeactivateReasons;

class DeactivateReasonService
{
 private $deactivateReasons;
 public function __construct(DeactivateReasons $deactivateReasons)
 {
   return $this->deactivateReasons = $deactivateReasons;
 }
 public function all(){
       return $this->deactivateReasons->latest('created_at')->get();
 }
 public function createOrUpdate($data){
  return  $this->deactivateReasons->updateORcreate(['id'=>$data['id']],$data);
 }
 public function delete($id) {
    return $this->deactivateReasons->find($id)->delete();
}

}

?>
