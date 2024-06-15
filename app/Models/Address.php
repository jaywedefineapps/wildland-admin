<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory, HasUuid, SoftDeletes;
    protected $table = 'address';
    protected $fillable = [
        'user_id',
        'type',
        'house_no',
        'address',
        'country_id',
        'province_id',
        'zipcode',
        'city_id',
        'is_default',
        'latitude',
        'longitude',
    ];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
}
