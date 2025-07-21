<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
protected $primaryKey = 'user_id'; // karena kamu ubah nama id
public $incrementing = true;
protected $keyType = 'int';

protected $fillable = [
    'kode_user',
    'nama_user',
    'user_email',
    'user_password',
    'user_role',
    'no_telp',
];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function userKeys()
    {
        return $this->hasMany(User_keys::class, 'user_id', 'user_id');
    }

    public function cart() 
    {
        return $this->hasOne(Cart::class);
    }

    public function getAuthIdentifierName()
    {
        return 'user_username';
        
    }
    public function getAuthPassword()
    {
        return $this->user_password;
    }
    public function wishlists()
    {
        return $this->belongsToMany(Key::class, 'wishlists', 'user_id', 'key_id')->withTimestamps();
    }

    
}
