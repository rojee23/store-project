<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouse';
    protected $primaryKey = 'warehouse_id';
    public $timestamps = false;

    protected $fillable = [
        'warehouse_name',
        'city',
        'address',
        'phone',
        'upload_file',
        'manager_id'
    ];

    // ============================
    //        RELATIONSHIPS
    // ============================

    // Manager (Personal Information)
    public function manager()
    {
        return $this->belongsTo(PersonalInformation::class, 'manager_id', 'personal_id');
    }

    // Employees working in this warehouse
    public function employees()
    {
        return $this->hasMany(PersonalInformation::class, 'warehouse_id', 'warehouse_id');
    }

    // Products in warehouse (Many-to-Many)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'warehouse_product', 'warehouse_id', 'product_id');
    }
}
