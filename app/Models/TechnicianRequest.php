<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TechnicianRequest extends Model
{
    use HasFactory, HasUuid, SoftDeletes;
    protected $table = 'technician_requests';
    protected $fillable = [
        'user_id',
        'technician_id',
        'status',
        'address_id',
        'date',
        'time_in',
        'time_out',
    ];
    protected $primaryKey = 'id';
    protected $appends = ['fitting'];
    protected $keyType = 'string';
    public $incrementing = false;

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function address() {
        return $this->hasOne(Address::class, 'id', 'address_id');
    }
    public function technician() {
        return $this->hasOne(User::class, 'id', 'technician_id');
    }
    public function getFittingAttribute() {
        if (!is_null($this->time_in) && is_null($this->time_out)) {
            return 'in_progress';
        } elseif (!is_null($this->time_in) && !is_null($this->time_out)) {
            return 'completed';
        }
        return null; 
    }
}
