<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarehouseProduct extends Model
{
    protected $table = 'warehouse_product';
    protected $primaryKey = 'id'; // إذا الجدول فيه id كـ PK
    public $timestamps = false;

    protected $fillable = [
        'warehouse_id',
        'product_id',
    ];

    // ============================
    //        RELATIONSHIPS
    // ============================

    // Warehouse
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'warehouse_id');
    }

    // Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
