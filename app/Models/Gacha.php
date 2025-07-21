<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Gacha extends Model
{
    use HasFactory;
    protected $table = 'gacha';
    protected $primaryKey = 'id_gacha';
    public $incrementing = false;
    protected $keyType = 'string';
}
