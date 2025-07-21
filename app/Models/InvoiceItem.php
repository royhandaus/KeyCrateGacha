<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_id', 'key_id', 'quantity', 'harga_satuan', 'total_price'];
    public function key()
    {
        return $this->belongsTo(Key::class, 'key_id');
    }

}

