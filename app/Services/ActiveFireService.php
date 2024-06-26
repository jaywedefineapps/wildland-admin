<?php

namespace App\Services;

use App\Models\ActiveFire;
use App\Models\ViirsSnppNrt;

class ActiveFireService {

    private $activeFire;
    private $viirnsSnppNrt;
    public function __construct(ActiveFire $activeFire , ViirsSnppNrt $viirnsSnppNrt) {
        $this->activeFire = $activeFire;
        $this->viirnsSnppNrt = $viirnsSnppNrt;
    }
    public function create($data) {
        return $this->activeFire->create($data);
    }
    public function createViirsSnppNrt($data) {
        return $this->viirnsSnppNrt->create($data);
    }

    public function truncate(){
        return $this->activeFire->truncate();
    }
    public function truncateViirsSnppNrt(){
        return $this->viirnsSnppNrt->truncate();
    }

    public function getFiresInCanadaAndUSA()
    {
        $canadaLatMin = 41.0;
        $canadaLatMax = 83.0;
        $canadaLonMin = -141.0;
        $canadaLonMax = -52.0;

        $usaLatMin = 24.5;
        $usaLatMax = 49.5;
        $usaLonMin = -125.0;
        $usaLonMax = -66.9;
        $firesInCanada = $this->activeFire
            // ->where('confidence', '>', 25)
            // ->where('brightness', '>', 300)
            // ->where('frp', '>', 20)
            ->whereRaw('CAST(latitude AS DECIMAL(10, 6)) BETWEEN ? AND ?', [$canadaLatMin, $canadaLatMax])
            ->whereRaw('CAST(longitude AS DECIMAL(10, 6)) BETWEEN ? AND ?', [$canadaLonMin, $canadaLonMax])
            ->get();

        $firesInUSA = $this->activeFire
            // ->where('confidence', '>', 25)
            // ->where('brightness', '>', 300)
            // ->where('frp', '>', 20)
            ->whereRaw('CAST(latitude AS DECIMAL(10, 6)) BETWEEN ? AND ?', [$usaLatMin, $usaLatMax])
            ->whereRaw('CAST(longitude AS DECIMAL(10, 6)) BETWEEN ? AND ?', [$usaLonMin, $usaLonMax])
            ->get();
        $firesInCanada2 = $this->viirnsSnppNrt
            // ->where('confidence', '>', 25)
            // ->where('brightness', '>', 300)
            // ->where('frp', '>', 20)
            ->whereRaw('CAST(latitude AS DECIMAL(10, 6)) BETWEEN ? AND ?', [$canadaLatMin, $canadaLatMax])
            ->whereRaw('CAST(longitude AS DECIMAL(10, 6)) BETWEEN ? AND ?', [$canadaLonMin, $canadaLonMax])
            ->get();

        $firesInUSA2 = $this->viirnsSnppNrt
            // ->where('confidence', '>', 25)
            // ->where('brightness', '>', 300)
            // ->where('frp', '>', 20)
            ->whereRaw('CAST(latitude AS DECIMAL(10, 6)) BETWEEN ? AND ?', [$usaLatMin, $usaLatMax])
            ->whereRaw('CAST(longitude AS DECIMAL(10, 6)) BETWEEN ? AND ?', [$usaLonMin, $usaLonMax])
            ->get();

        // $fires = $firesInCanada->merge($firesInUSA);
        // $fires = $this->activeFire->all();
        // $fires2 = $this->viirnsSnppNrt->all();

        //temprory condition test
        // $fires = $this->activeFire->where('brightness', '>', 300)->where('confidence', '>', 25)->where('frp', '>', 25)->get();
        // $fires2 = $this->viirnsSnppNrt->where('bright_ti4' , '>' ,300)->where('bright_ti5' , '>' ,280)->where('frp', '>', 0.1)->get();

        // $mergedFires = $fires2->merge($fires);
        
        $mergedFires = $firesInUSA->merge($firesInCanada);
        $mergedFires2 = $firesInUSA2->merge($firesInCanada2);
        $mergedFires3 = $mergedFires2->merge($mergedFires);
        return $mergedFires3 ;
    }

}
?>
