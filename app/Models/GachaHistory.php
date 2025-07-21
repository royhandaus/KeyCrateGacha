<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GachaHistory extends Model
{
    protected $fillable = [
        'user_id', 'crate_id', 'item_name', 'item_image', 'rate',
    ];
    public function crate()
    {
        return $this->belongsTo(\App\Models\Crate::class, 'crate_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
    


}

