<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $guarded = [];

    public $appends = [
        'address'
    ];

    public function getAddressAttribute($value)
    {
        $addressParts = [
            $this->address_line_1,
            $this->address_line_2,
            $this->landmark,
            $this->city,
            optional($this->state)->name,
            optional($this->country)->name,
            $this->pincode,
        ];

        // Filter out any empty/null parts
        $addressParts = array_filter($addressParts);

        // Join with comma
        return implode(', ', $addressParts);
    }
    public function Users()
    {
        return $this->belongsTo(User::class);
    }

    public function getPhoneNoAttribute($value)
    {
        return decrypt_to($value);
    }


    public function country()
    {
        return $this->belongsTo(ModuleCountry::class, 'country_id', 'id');
    }
    public function state()
    {
        return $this->belongsTo(ModuleState::class, 'state_id', 'id');
    }

}
