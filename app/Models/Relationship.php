<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Relationship extends Model
{
    protected $table = 'relationship';
    protected $fillable = ['name'];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    use HasFactory, HasUuid, SoftDeletes;
}
