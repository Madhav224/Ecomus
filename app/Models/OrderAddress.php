<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    protected $guarded = [];
    public $appends = [
        'address'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function country()
    {
        return $this->belongsTo(ModuleCountry::class);
    }

    public function state()
    {
        return $this->belongsTo(ModuleState::class);
    }
    public function getAddressAttribute($value)
    {
        $addressParts = [
            $this->address_line_1,
            $this->address_line_2 ,
            $this->landmark,
            $this->city,
            $this->state_name,
            $this->country_name,
            $this->pincode,
        ];

        // Filter out any empty/null parts
        $addressParts = array_filter($addressParts);

        // Join with comma
        return implode(', ', $addressParts);
    }
}
