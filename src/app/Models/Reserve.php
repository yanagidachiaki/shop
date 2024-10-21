<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;

      protected $fillable = [
        'shopname',
        'reserve_id',
        'area',
        'genre',
    ];

     public function shops()
    {
         return $this->belongsToMany(Shop::class);
    }

     public function users()
    {
         return $this->belongsToMany(User::class);
    }
}
