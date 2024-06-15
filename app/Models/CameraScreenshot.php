<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CameraScreenshot extends Model
{
    use HasFactory, HasUuid;
    protected $table = 'camera_screenshots';
    protected $fillable = [
        'user_id',
        'camera_id',
        'image',
        'channel_no',
    ];
    public $appends = ['camera_image'];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function getCameraImageAttribute()
    {
        
        if ($this->image) {
            return getAzureImg($this->image);
        } else {
            return null;
        }
    }
}
