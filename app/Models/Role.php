<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';

    protected $primaryKey = 'role_id';

    public $timestamps = false;

    protected $fillable = [
        'type',
    ];

    // ============================
    //        RELATIONSHIPS
    // ============================

    // Employees (Personal Information)
    public function employees()
    {
        return $this->hasMany(PersonalInformation::class, 'role_id', 'role_id');
    }
}
