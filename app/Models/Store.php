<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'store';

    protected $primaryKey = 'store_id';

    public $timestamps = false;

    protected $fillable = [
        'store_name',
        'city',
        'address',
        'phone',
        'upload_file',
    ];

    // ============================
    //        RELATIONSHIPS
    // ============================

    // Employees (Personal Information)
    public function employees()
    {
        return $this->hasMany(PersonalInformation::class, 'store_id', 'store_id');
    }

    // Products in store (Many-to-Many)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_store', 'store_id', 'product_id');
    }
}
