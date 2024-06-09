<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    protected $table = 'settings';
    protected $fillable = [
        'app_name',
        'support_email',
        'stripe_secret_key',
        'stripe_publish_key',
        'smtp_host',
        'smtp_username',
        'smtp_password',
        'smtp_port',
        'aws_access_key',
        'aws_secret_key',
        'aws_region',
        'aws_bucket_name',
        'twilio_account_id',
        'twilio_token',
        'twilio_from',
        'notification_url',
        'notification_key',
        'pagination_size',
        'app_version',
        'ios_app_version',
        'currency',
        'commision',
        'transaction_charge',
        'home_page_size',
        'affiliate_commission',
        'minimum_withdraw_amount',
        'tax_amount',
        'tax_percentage',
        'tax_type'
    ];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    use HasFactory, HasUuid;
}
