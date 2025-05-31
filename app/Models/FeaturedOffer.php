<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturedOffer extends Model
{
    protected $fillable = [
        'offer_id',
        'affiliates',
        'countries',
        'devices' 
    ];
}
