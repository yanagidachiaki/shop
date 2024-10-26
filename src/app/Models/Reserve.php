<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;

      protected $fillable = [
        'shop_id',
        'user_id',
        'day',
        'time',
        'number'
    ];

     public function shop()
    {
         return $this->belongsTo(Shop::class);
    }

     public function users()
    {
         return $this->belongsToMany(User::class);
    }
}
