<?php

namespace App\Services;

use App\Models\HelpSupport;

class HelpSupportsService
{

    private $helpSupport;
    public function __construct(HelpSupport $helpSupport)
    {
        $this->helpSupport = $helpSupport;
    }

    public function create($data)
    {
        return $this->helpSupport->create($data);
    }

    public function update($id, $data)
    {
        return $this->helpSupport->find($id)->fill($data)->save();
    }

    public function delete($id)
    {
        $user = $this->helpSupport->find($id);
        return $user->delete();
    }

    public function all()
    {
        return $this->helpSupport->paginate();
    }
    public function getByType($type)
    {
        return $this->helpSupport->where('type',$type)->paginate();
    }
}
