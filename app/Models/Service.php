<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'logo',
        'cover',
        'category',
        'address',
        'location_lat',
        'location_long',
        'about',
        'gallery',
        'services',
        'service_list'
    ];


    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function ratings() {
        return $this->hasMany('App\Models\Rating');
    }
}
