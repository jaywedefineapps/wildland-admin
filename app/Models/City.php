<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    protected $table = 'cities';
    protected $fillable = ['name', 'province_id'];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    use HasFactory, HasUuid, SoftDeletes;

    public function provinceData() {
        return $this->belongsTo(Province::class,'province_id');
    }
}
