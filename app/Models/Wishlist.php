<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    use HasFactory;

    protected $table = 'wishlists'; // nama tabel di database

    protected $fillable = [
        'user_id',
        'key_id',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // Relasi ke key
    public function key()
    {
        return $this->belongsTo(Key::class, 'key_id', 'id');
    }
}

