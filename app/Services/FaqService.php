<?php

namespace App\Services;

use App\Models\Faq;

class FaqService {

    private $faq;
    public function __construct(Faq $faq) {
        $this->faq = $faq;
    }

    public function create($data) {
        return $this->faq->create($data);
    }

    public function delete($id) {
        return $this->faq->find($id)->delete();
    }
    public function createOrUpdate($data){
        return  $this->faq->updateORcreate(['id'=>$data['id']],$data);
       }

    public function update($id,$data) {
        return $this->faq->find($id)->update($data);
    }

    public function get(){
        return $this->faq->get();
    }
    public function getByType($type){
        return $this->faq->where('type',$type)->get();
    }

}