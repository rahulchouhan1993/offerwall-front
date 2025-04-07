<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrafficTracking extends Model
{
    protected $fillable = [
        'tracking_id',
        'device',
        'os',
        'country',
        'caps',
        'agent',
    ];
}
