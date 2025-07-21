<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    protected $table = 'shop_key'; // nama tabel sesuai milikmu
    protected $primaryKey = 'id';

    protected $fillable = ['nama_key', 'harga_key', 'image_key', 'delete_key', 'kode_user'];
    public function crate()
    {
        return $this->belongsTo(Crate::class, 'crate_id');
    }
    public function scopeActive($query)
    {
        return $query->where('deleted', 0);
    }
    public function wishlistedBy()
    {
        return $this->belongsToMany(User::class, 'wishlists', 'key_id', 'user_id')->withTimestamps();
    }

}

