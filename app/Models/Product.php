<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'product_id';
    public $timestamps = false;

    protected $fillable = [
        'product_name',
        'price',
        'description',
        'upload_file',
    ];

    // ============================
    //        RELATIONSHIPS
    // ============================

    // Stores that have this product (Many-to-Many)
    public function stores()
    {
        return $this->belongsToMany(
            Store::class,
            'product_store',
            'product_id',
            'store_id'
        );
    }

    // Warehouses that have this product (Many-to-Many)
    public function warehouses()
    {
        return $this->belongsToMany(
            Warehouse::class,
            'warehouse_product',
            'product_id',
            'warehouse_id'
        );
    }
}
