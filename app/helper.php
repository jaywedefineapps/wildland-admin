<?php

use Carbon\Carbon;
use App\Models\User;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\PayMongoToken;
use Ixudra\Curl\Facades\Curl;
use App\Jobs\SendNotification;
use App\Models\AffiliateLevel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

function getAzureImg($key) {
    if (Storage::disk('azure')->exists($key)) {
        $expiry = now()->addMinutes(20);
        $presignedUrl = Storage::disk('azure')->temporaryUrl($key, $expiry);
        return $presignedUrl;
    } else {
        return null;
    }
}

function get_row_by_id($id, $tblname, $colname){
    return DB::table($tblname)->where($colname,$id)->first();
 }

function generateRandomString($length = 25) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if (!function_exists('mediaUpload')) {
    function mediaUpload($folderPath, $file, $type = 'file') {
        $folderPath = rtrim($folderPath, '/');
        $path = 'assets/' . $folderPath;

        if (!file_exists(public_path($path))) {
            mkdir(public_path($path), 0777, true);
        }

        if ($type === 'base64') {
            // Handle Base64 image
            $img_extension = 'png'; // Default extension for Base64 images
            $filename = time() . generateRandomString(6) . '.' . $img_extension;
            $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $file));
            file_put_contents(public_path($path . '/' . $filename), $fileData);
        } else {
            // Handle file upload
            $img_extension = $file->getClientOriginalExtension();
            $filename = time() . generateRandomString(6) . '.' . $img_extension;
            $file->move(public_path($path), $filename);
        }

        return $filename;
    }
}

if (!function_exists('mediaUploadAzure')) {
    function mediaUploadAzure($path, $file, $type = 'file') {
        $path = rtrim($path, '/');

        if ($type === 'base64') {
            // Handle Base64 image
            $img_extension = 'png'; // Default extension for Base64 images
            $filename = time() . generateRandomString(6) . '.' . $img_extension;
            $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $file));
            $filePath = $path . '/' . $filename;
            Storage::disk('azure')->put($filePath, $fileData, 'private');
        } else {
            $img_extension = $file->getClientOriginalExtension();
            $filename = time() . generateRandomString(6) . '.' . $img_extension;
            $filePath = $path . '/' . $filename;
            Storage::disk('azure')->put($filePath, file_get_contents($file), 'private');
        }

        return $filePath;
    }
}
if (!function_exists('unlinkFile')) {
    function unlinkFile($filePath) {
        $fullPath = public_path($filePath);

        if (file_exists($fullPath)) {
            unlink($fullPath);
            return true;
        }

        return false;
    }
}
function getFileExtension($fileName)
{
    return '.' . strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
}

function stringReadMoreInline($str,$length) {
    $strOk = nl2br($str);
    if (strlen($str) > $length) {
        $delim = "~\n~";
        $append = '<span style="display:none;" class="full-string-span">' . substr($strOk, $length, strlen($str)) . '</span><a href="#" class="link inline-readmore"><span class="more-text"><small>...more</small></span><span class="less-text" style="display:none;"><small>...less</small></span></a>';
        $str = substr($strOk,0,$length).$append;
    }
    return $str;
}


function bannerType() {
    return [
        ['id' => 'home', 'name' => 'Home Screen'],
        ['id' => 'service', 'name' => 'Service Screen'],
        ['id' => 'checkout', 'name' => 'Checkout Screen'],
    ];
}

function taxFilter() {
    return [
        ['id' => 'one_month', 'name' => 'One Month'],
        ['id' => 'six_month', 'name' => 'Six Month'],
        ['id' => 'year', 'name' => 'Last Year'],
    ];
}

function getAgeFromDob($dob) {
    $age = \Carbon\Carbon::now()->diffInYears($dob);
    return $age;
}

function weekDays() {
    return array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
}

function getSettings() {
    return DB::table('settings')->get()->first();
}

function yearDifference($date) {
    $toDate = Carbon::parse($date);
    $fromDate = Carbon::now();
    return $toDate->diffInYears($fromDate);
}
function isBase64Image($data)
{
    // Remove data URI scheme (e.g., 'data:image/png;base64,') from the beginning
    $data = preg_replace('#^data:image/[^;]+;base64,#', '', $data);

    // Decode the base64 string
    $decodedData = base64_decode($data, true);

    // Check if the decoding was successful and the result is a valid image
    if ($decodedData !== false && @imagecreatefromstring($decodedData) !== false) {
        return true;
    }

    return false;
}
?>
