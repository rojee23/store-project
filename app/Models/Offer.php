<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'offer';
    protected $primaryKey = 'offer_id';
    public $timestamps = false;

    protected $fillable = [
        'offer_name',
        'offer_details',
        'start_date',
        'end_date',
        'status',
    ];

    public function employees()
    {
        return $this->belongsToMany(
            PersonalInformation::class,
            'offer_personalinformation',
            'offer_id',
            'personal_id'
        )->withPivot('employee_status_id');
    }
}
