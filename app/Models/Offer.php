<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferPersonalInformation extends Model
{
    protected $table = 'offer_personalinformation';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'offer_id',
        'personal_id',
        'employee_status_id',
        'status',
    ];

    // ============================
    //        RELATIONSHIPS
    // ============================

    // Offer
    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id', 'offer_id');
    }

    // Employee (Personal Information)
    public function employee()
    {
        return $this->belongsTo(PersonalInformation::class, 'personal_id', 'personal_id');
    }
}
