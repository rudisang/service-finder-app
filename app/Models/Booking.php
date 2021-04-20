<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'user_id',
        'title',
        'start',
        'end',
        'confirmed',
        'message'
    ];

    public function service(){
        return $this->belongsTo('App\Models\Service');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
