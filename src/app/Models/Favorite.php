<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'shop_id',
    ];


    // Favoriteは1人のユーザーに属する
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Favoriteは1つのショップに属する
    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }
}