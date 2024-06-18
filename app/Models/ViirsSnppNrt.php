<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ViirsSnppNrt extends Model
{
    use HasFactory, HasUuid ;
    protected $table = 'active_fires';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'latitude',
        'longitude',
        'bright_ti4', //bright_ti4 - actule name 
        'scan',
        'track',
        'acq_date',
        'acq_time',
        'satellite',
        'instrument',
        'confidence',
        'version',
        'bright_ti5', //bright_ti5- actule name 
        'frp',
        'daynight',
    ];
}
