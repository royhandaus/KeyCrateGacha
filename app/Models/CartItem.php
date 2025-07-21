<?php


// app/Models/CartItem.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['cart_id', 'key_id', 'quantity', 'harga_satuan'];

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'cart_id');
    }

    public function key()
    {
        return $this->belongsTo(Key::class, 'key_id', 'id');
    }
}
