<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserValve extends Model
{
    use HasFactory, HasUuid, SoftDeletes;
    protected $table = 'user_valve';
    protected $fillable = [
        'user_id',
        'address_id',
        'valve_api_key',
    ];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function addressData(){
        return $this->belongsTo(Address::class ,'address_id','id');
    }
}
