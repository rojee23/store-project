<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductStore extends Model
{
    protected $table = 'product_store';
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'store_id'
    ];

    // ============================
    //        RELATIONSHIPS
    // ============================

    // Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    // Store
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'store_id');
    }
}
