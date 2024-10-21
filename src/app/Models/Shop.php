<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

       protected $fillable = [
        'shopname',
        'reserve_id',
        'area',
        'genre',
    ];


     public function favorites()
    {
         return $this->hasMany(Favorite::class);
    }

     public function reserves()
    {
         return $this->hasMany(Reserve::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
