<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarehouseStore extends Model
{
    protected $table = 'warehouse_store';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'warehouse_id',
        'store_id',
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'warehouse_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'store_id');
    }
}
