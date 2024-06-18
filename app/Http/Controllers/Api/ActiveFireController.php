<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ActiveFireService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ActiveFireController extends Controller
{
    private $activeFireService;
    public function __construct(ActiveFireService $activeFireService) {
        $this->activeFireService = $activeFireService;
    }

    public function setTableData(){
        $currentDate = Carbon::now()->format('Y-m-d');
        $response = Http::get('https://firms.modaps.eosdis.nasa.gov/api/area/csv/5cd8bf082b0eb8dbc40701e0633c65b5/MODIS_NRT/world/1/'.$currentDate ); //2024-06-01');
        // $response = Http::get('https://firms.modaps.eosdis.nasa.gov/api/area/csv/5cd8bf082b0eb8dbc40701e0633c65b5/VIIRS_SNPP_NRT/world/1/'.$currentDate ); //2024-06-01');
        $csvData = $response->body();
        if(!empty($csvData)){
            $rows = explode("\n", trim($csvData));
            $header = str_getcsv(array_shift($rows));
            $data = array();

            foreach ($rows as $row) {
                $rowData = str_getcsv($row);
                if (count($rowData) == count($header)) {
                    $data[] = array_combine($header, $rowData);
                }
            }
            $this->activeFireService->truncate();
            foreach($data as $value){
                $this->activeFireService->create($value);
            }
        }
    }

    public function getActiveFireData(Request $request){
        $data = $this->activeFireService->getFiresInCanadaAndUSA();
        return response()->json(['status' => 1, 'message' => trans('message.SUCCESS'), 'response' => $data], 200);

    }
}
