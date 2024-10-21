<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'genre',
    ];

       public function users()
    {
         return $this->hasOne(User::class);
    }
    
    public function shops()
    {
         return $this->hasOne(Shop::class);
    }
}
