<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crate extends Model
{
    protected $table = 'crates';

    protected $fillable = [
        'name', 'crate_image', 'owner_id',
        'item1_name', 'item1_image', 'item1_rate', 'item1_stok',
        'item2_name', 'item2_image', 'item2_rate', 'item2_stok',
        'item3_name', 'item3_image', 'item3_rate', 'item3_stok',
        'item4_name', 'item4_image', 'item4_rate', 'item4_stok',
        'item5_name', 'item5_image', 'item5_rate', 'item5_stok',
        'key_id', 'status', 'deleted',
    ];

    public function key()
    {
        return $this->belongsTo(Key::class, 'key_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'crate_id', 'id');
    }
    public function gachaHistories()
    {
        return $this->hasMany(\App\Models\GachaHistory::class, 'crate_id');
    }


}
