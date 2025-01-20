<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * Dapatkan kunci utama yang akan disimpan dalam token.
     */
    public function getJWTIdentifier()
    {
        return $this->getKey(); // Menggunakan primary key dari model
    }

    /**
     * Dapatkan custom claims yang akan ditambahkan ke token.
     */
    public function getJWTCustomClaims()
    {
        return []; // Tidak ada custom claims
    }
}