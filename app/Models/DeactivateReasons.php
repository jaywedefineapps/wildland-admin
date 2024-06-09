<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeactivateReasons extends Model
{
    use HasFactory, HasUuid, SoftDeletes;
    protected $table = 'deactivate_reasons';
    protected $fillable = ['content'];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
}
