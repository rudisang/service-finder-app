<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id',
        'user_id',
        'rating',
        'review'
    ];
    public function service() {
        return $this->belongsTo('App\Models\Service');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

}
