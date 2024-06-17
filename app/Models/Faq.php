<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faq extends Model
{
    use HasFactory, HasUuid, SoftDeletes;
    protected $table = 'faq';
    protected $fillable = [
        'question',
        'answer',
        'type',
    ];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
}
