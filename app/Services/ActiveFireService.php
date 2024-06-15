<?php

namespace App\Services;

use App\Models\ActiveFire;

class ActiveFireService {

    private $activeFire;
    public function __construct(ActiveFire $activeFire) {
        $this->activeFire = $activeFire;
    }
    public function create($data) {
        return $this->activeFire->create($data);
    }

    public function truncate(){
        return $this->activeFire->truncate();
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
        ->where('confidence', '>', 50)
        ->where('brightness', '>', 250)
        ->where('frp', '>', 40)
        ->whereRaw('CAST(latitude AS DECIMAL(10, 6)) BETWEEN ? AND ?', [$canadaLatMin, $canadaLatMax])
        ->whereRaw('CAST(longitude AS DECIMAL(10, 6)) BETWEEN ? AND ?', [$canadaLonMin, $canadaLonMax])
        ->get();

    $firesInUSA = $this->activeFire
        ->where('confidence', '>', 50)
        ->where('brightness', '>', 250)
        ->where('frp', '>', 40)
        ->whereRaw('CAST(latitude AS DECIMAL(10, 6)) BETWEEN ? AND ?', [$usaLatMin, $usaLatMax])
        ->whereRaw('CAST(longitude AS DECIMAL(10, 6)) BETWEEN ? AND ?', [$usaLonMin, $usaLonMax])
        ->get();

        $fires = $firesInCanada->merge($firesInUSA);

        return $fires;
    }

}
?>
