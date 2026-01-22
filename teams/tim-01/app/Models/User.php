<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Nama tabel (opsional tapi aman)
     */
    protected $table = 'users';

    /**
     * Kolom yang boleh diisi (sesuai DB kamu)
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'full_name',
        'role',
    ];

    /**
     * Kolom yang disembunyikan
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting attribute
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];
}
