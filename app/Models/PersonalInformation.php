<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\EmployeeStatus;
use App\Models\Department;
use App\Models\Role;
use App\Models\Warehouse;
use App\Models\Store;
use App\Models\CustomerStatus;
use App\Models\CustomerType;
use App\Models\Offer;

class PersonalInformation extends Model
{
    protected $table = 'personal_information';
    protected $primaryKey = 'personal_id';
    public $timestamps = false;

    protected $fillable = [
        'manager_id',
        'firstName',
        'lastName',
        'father',
        'mother',
        'birthday',
        'gender',
        'national_number',
        'phone',
        'email',
        'address',
        'salary',
        'upload_file',
        'store_id',
        'role_id',
        'department_id',
        'warehouse_id',
        'employee_status_id',   // ✔ مهم جداً
        'customer_status_id',
        'customer_type_id',
        'user_id',
    ];

    // ============================
    //        RELATIONSHIPS
    // ============================

    // Manager (self relation)
    public function manager()
    {
        return $this->belongsTo(PersonalInformation::class, 'manager_id', 'personal_id');
    }

    // Store
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'store_id');
    }

    // Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    // Department
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'department_id');
    }

    // Warehouse
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'warehouse_id');
    }

    // ⭐ Employee Status (العلاقة الصحيحة)
    public function employeeStatus()
    {
        return $this->belongsTo(EmployeeStatus::class, 'employee_status_id', 'employee_status_id');
    }

    // Customer Status
    public function customerStatus()
    {
        return $this->belongsTo(CustomerStatus::class, 'customer_status_id', 'customer_status_id');
    }

    // Customer Type
    public function customerType()
    {
        return $this->belongsTo(CustomerType::class, 'customer_type_id', 'customer_type_id');
    }

    // User (Login)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // Offers (Many-to-Many)
    public function offers()
    {
        return $this->belongsToMany(
            Offer::class,
            'offer_personalinformation',
            'personal_id',
            'offer_id'
        )->withPivot('employee_status_id', 'status');
    }
}
