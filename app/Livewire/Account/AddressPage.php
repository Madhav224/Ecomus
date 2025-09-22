<?php

namespace App\Livewire\Account;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAddress;
use App\Models\ModuleCountry;
use App\Models\ModuleState;

class AddressPage extends Component
{
    public $name, $phone_no, $pincode, $address_line_1, $address_line_2, $landmark, $city
    // $state_id, $country_id
    ;

    public function saveAddress()
    {
        $this->validate([
            'name'           => 'required|string|max:255',
            'phone_no'       => 'required|string|max:20',
            'pincode'        => 'nullable|string|max:10',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'landmark'       => 'nullable|string|max:255',
            'city'           => 'required|string|max:100',
            // 'state_id'       => 'required|integer',
            // 'country_id'     => 'required|integer',
        ]);

        UserAddress::create([
            'user_id'        => Auth::id(),
            'name'           => $this->name,
            'phone_no'       => $this->phone_no,
            'pincode'        => $this->pincode,
            'address_line_1' => $this->address_line_1,
            'address_line_2' => $this->address_line_2,
            'landmark'       => $this->landmark,
            'city'           => $this->city,
            // 'state_id'       => $this->state_id,
            // 'country_id'     => $this->country_id,
            'default'        => 0,
        ]);

        session()->flash('success', 'Address saved successfully!');
        $this->reset();
    }

       public function deleteAddress($id)
    {
        $address = UserAddress::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $address->delete();

        session()->flash('success', 'Address deleted successfully!');
    }


    public function editAddress($id)
{
    $address = UserAddress::findOrFail($id);

    $this->name           = $address->name;
    $this->phone_no       = $address->phone_no;
    $this->pincode        = $address->pincode;
    $this->address_line_1 = $address->address_line_1;
    $this->address_line_2 = $address->address_line_2;
    $this->landmark       = $address->landmark;
    $this->city           = $address->city;
    // $this->state_id       = $address->state_id;
    // $this->country_id     = $address->country_id;
}

    public function render()
    {
        $addresses = Auth::user()->Address;

        return view('livewire.account.address-page', compact('addresses'))
            ->extends('frontend.layouts.app')
            ->section('content');
    }
}

