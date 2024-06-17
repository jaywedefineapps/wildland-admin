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
        'image',
    ];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $appends = ['address_image'];
    public $incrementing = false;

    public function getAddressImageAttribute()
    {
        if ($this->image) {
            return asset('assets/address/'.$this->image);
        } else {
            return null;
        }
    }
}
