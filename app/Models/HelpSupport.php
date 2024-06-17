<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasUuid;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
class HelpSupport extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasUuid, SoftDeletes;

    protected $table = 'help_support_queries';
    protected $fillable = [
        'user_id',
        'email',
        'message',
        'type',
    ];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
}
