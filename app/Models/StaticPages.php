<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class StaticPages extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasUuid, SoftDeletes;

    protected $table = 'static_pages';
    protected $fillable = [
        'type',
        'title',
        'content',
    ];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
}
