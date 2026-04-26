<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerType extends Model
{
    protected $table = 'customer_type';
    protected $primaryKey = 'customer_type_id';
    public $timestamps = false;

    protected $fillable = [
        'type',
    ];

    public function personalInformation()
    {
        return $this->hasMany(PersonalInformation::class, 'customer_type_id', 'customer_type_id');
    }
}
