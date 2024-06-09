<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    protected $table = 'provinces';
    protected $fillable = ['name', 'country_id'];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    use HasFactory, HasUuid, SoftDeletes;
    public function countryData()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
