<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserFirebase extends Model
{
    use HasFactory, HasUuid;
    protected $table = 'user_firebase';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'device_id',
        'device_name',
        'fcm_token',
        'user_id',
        'platform',
    ];
}
