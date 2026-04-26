<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id'; // مهم جداً إذا جدول users عندك فيه user_id وليس id

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ============================
    //        RELATIONSHIPS
    // ============================

    // علاقة User → PersonalInformation (1:N)
    public function personalInformation()
    {
        return $this->hasMany(PersonalInformation::class, 'user_id', 'user_id');
    }
}
