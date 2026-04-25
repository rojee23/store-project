<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'department';

    protected $primaryKey = 'department_id';

    public $timestamps = false;

    protected $fillable = [
        'department_name',
    ];

    // ============================
    //        RELATIONSHIPS
    // ============================

    // Employees (Personal Information)
    public function employees()
    {
        return $this->hasMany(PersonalInformation::class, 'department_id', 'department_id');
    }
}
