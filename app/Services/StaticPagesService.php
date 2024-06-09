<?php

namespace App\Services;

use App\Models\StaticPages;

class StaticPagesService
{

    private $staticPages;
    public function __construct(StaticPages $staticPages)
    {
        $this->staticPages = $staticPages;
    }

    public function create($data)
    {
        return $this->staticPages->create($data);
    }

    public function update($type, $data)
    {
        $policy = $this->staticPages->where('type', $type)->first();
        if ($policy) {
            $policy->fill($data)->save();
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $user = $this->staticPages->find($id);
        return $user->delete();
    }

    public function getContentByType($type)
    {
        return $this->staticPages->where('type', $type)->get();
    }

    public function getStaticDataByType($type)
    {
        return $this->staticPages->where('type', $type)->get();
    }
}
