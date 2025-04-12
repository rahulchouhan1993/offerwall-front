<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    protected $fillable = [
        'visitor_id',
        'app_id',
        'offer_id',
        'offer_name',
        'user_id',
        'affiliate_id',
        'country_code',
        'country_name',
        'browser',
        'device_brand',
        'device_model',
        'device_os',
        'device_type',
        'isp',
        'ip',
        'ua',
        'goal',
        'reward',
        'click_id',
        'click_time',
        'conversion_id',
        'conversion_time',
        'payout',
        'revenue',
        'postback_sent',
        'postback_url',
        'http_code',
        'error',
        'signature',
        'status',
        'reason'
    ];
}
