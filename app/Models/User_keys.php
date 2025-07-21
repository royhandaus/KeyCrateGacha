<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserKey extends Model
{
    protected $table = 'user_keys'; // sesuai tabel kamu
    protected $primaryKey = 'user_key_id'; // sesuai dengan kolom PK di DB kamu

    protected $fillable = [
        'user_id',
        'key_id',
        'jumlah'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function key()
    {
        return $this->belongsTo(Key::class, 'key_id', 'id');
    }
}
