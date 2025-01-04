<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelSettings extends Model
{
    protected $fillable = [
        'hotel_name',
        'email',
        'phone',
        'address',
        'facebook_url',
        'instagram_url',
        'twitter_url',
    ];
} 