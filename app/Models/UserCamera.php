<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserCamera extends Model
{
    use HasFactory, HasUuid, SoftDeletes;
    protected $table = 'user_cameras';
    protected $fillable = [
        'user_id',
        'address_id',
        'port',
        'ip_address',
        'device_name',
        'user_name',
        'password',
        'channel_count',
    ];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function cameraScreenshots() {
        return $this->hasMany(CameraScreenshot::class, 'camera_id');
    }
    public function address() {
        return $this->hasOne(Address::class, 'id', 'address_id');
    }
    
}
