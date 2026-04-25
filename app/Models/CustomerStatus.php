<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerStatus extends Model
{
    protected $table = 'customer_status';
    protected $primaryKey = 'customer_status_id';
    public $timestamps = false;

    protected $fillable = [
        'status'
    ];

    // ============================
    //        RELATIONSHIPS
    // ============================

    // Employees (Personal Information)
    public function employees()
    {
        return $this->hasMany(PersonalInformation::class, 'customer_status_id', 'customer_status_id');
    }
}
