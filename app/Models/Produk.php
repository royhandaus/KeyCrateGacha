<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'produk_id';

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'stok_produk',
        'kode_redeem_produk',
        'rating',
        'available_produk',
        'crate_id', // pastikan kolom ini ada di tabel 'produk'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }

    public function crate()
    {
        return $this->belongsTo(Crate::class, 'crate_id', 'id');
    }
}
