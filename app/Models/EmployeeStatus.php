<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeStatus extends Model
{
    protected $table = 'employee_status';
    protected $primaryKey = 'employee_status_id';
    public $timestamps = false;

    protected $fillable = [
        'status',
    ];

    public function personalInformation()
    {
        return $this->hasMany(PersonalInformation::class, 'employee_status_id', 'employee_status_id');
    }
}
