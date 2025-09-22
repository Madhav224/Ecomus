<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAddress;
use App\Models\ModuleCountry;
use App\Models\ModuleState;

class AccountPage extends Component
{
    use WithFileUploads;

    public $tab = 'profile';

//     // Profile fields
//     public $name, $email, $phone_no, $gender, $dob, $pincode;

//     // Address fields
//     public $addr_name, $addr_phone_no, $addr_pincode, $address_line_1, $address_line_2, $landmark, $city, $state_id, $country_id;

//     public function mount()
//     {
//         $user = Auth::user();

//         // Profile
//         $this->name     = $user->name;
//         $this->email    = $user->email;
//         $this->phone_no = $user->phone_no;
//         $this->gender   = $user->gender;
//         $this->dob      = $user->dob;
//         $this->pincode  = $user->pincode;
//     }

//     /** =====================
//      * Update Profile
//      * ===================== */
//     public function updateProfile()
//     {
//         $this->validate([
//             'name'     => 'required|string|max:255',
//             'phone_no' => 'nullable|string|max:20',
//             'dob'      => 'nullable|date',
//             'gender'   => 'nullable|in:male,female,other',
//             'pincode'  => 'nullable|string|max:10',
//         ]);

//         Auth::user()->update([
//             'name'     => $this->name,
//             'phone_no' => $this->phone_no,
//             'dob'      => $this->dob,
//             'gender'   => $this->gender,
//             'pincode'  => $this->pincode,
//         ]);

//         session()->flash('success', 'Profile updated successfully!');
//     }

//     /** =====================
//      * Save Address
//      * ===================== */
//     public function saveAddress()
//     {
//         $this->validate([
//             'addr_name'       => 'required|string|max:255',
//             'addr_phone_no'   => 'required|string|max:20',
//             'addr_pincode'    => 'nullable|string|max:10',
//             'address_line_1'  => 'required|string|max:255',
//             'address_line_2'  => 'nullable|string|max:255',
//             'landmark'        => 'nullable|string|max:255',
//             'city'            => 'required|string|max:100',
//             'state_id'        => 'required|integer',
//             'country_id'      => 'required|integer',
//         ]);

//         UserAddress::create([
//             'user_id'        => Auth::id(),
//             'name'           => $this->addr_name,
//             'phone_no'       => $this->addr_phone_no,
//             'pincode'        => $this->addr_pincode,
//             'address_line_1' => $this->address_line_1,
//             'address_line_2' => $this->address_line_2,
//             'landmark'       => $this->landmark,
//             'city'           => $this->city,
//             'state_id'       => $this->state_id,
//             'country_id'     => $this->country_id,
//             'default'        => 0, // not default by default
//         ]);

//         session()->flash('success', 'Address saved successfully!');
//         $this->resetAddressForm();
//     }

//     private function resetAddressForm()
//     {
//         $this->addr_name = $this->addr_phone_no = $this->addr_pincode = null;
//         $this->address_line_1 = $this->address_line_2 = $this->landmark = $this->city = null;
//         $this->state_id = $this->country_id = null;
//     }

//     public function render()
//     {
//         return view('livewire.account-page', [
//             'user'      => Auth::user(),
//             'addresses' => Auth::user()->Address,
//             'orders'    => Auth::user()->order,
//             'countries' => ModuleCountry::all(),
//             'states'    => ModuleState::all(),
//         ])->extends('frontend.layouts.app')->section('content');
//     }
// }





   


     // Profile fields
   public $name, $email, $phone_no, $gender, $dob, $pincode;

    // Address fields
     public  $address_line_1, $address_line_2, $landmark, $city, $state_id, $country_id;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone_no = $user->phone_no;
        $this->gender = $user->gender;
        $this->dob = $user->dob;
        $this->pincode = $user->pincode;
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'phone_no' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'pincode' => 'nullable|string|max:10',
        ]);

        Auth::user()->update([
            'name' => $this->name,
            'phone_no' => $this->phone_no,
            'dob' => $this->dob,
            'gender' => $this->gender,
            'pincode' => $this->pincode,
        ]);

        session()->flash('success', 'Profile updated successfully!');
    }

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
            'state_id'       => 'required|integer',
            'country_id'     => 'required|integer',
        ]);

        UserAddress::create([
            'user_id'        => Auth::id(),
            'name'           => $this->name,
            'phone_no'       => $this->phone_no, // encryption handled in model accessor if needed
            'pincode'        => $this->pincode,
            'address_line_1' => $this->address_line_1,
            'address_line_2' => $this->address_line_2,
            'landmark'       => $this->landmark,
            'city'           => $this->city,
            'state_id'       => $this->state_id,
            'country_id'     => $this->country_id,
            'default'        => 0, // default to non-primary
        ]);

        session()->flash('success', 'Address saved successfully!');
        $this->reset(); // clear form
    }


    public function render()
    {
        return view('livewire.account-page', [
            'user' => Auth::user(),
            'addresses' => Auth::user()->Address,
            'orders' => Auth::user()->order,
        ])->extends('frontend.layouts.app')->section('content');
    }

}










    // // Profile fields
    // public $name, $email, $phone, $gender, $dob, $avatar;

    // // Address fields
    // public $address_line_1, $address_line_2, $landmark, $city, $state_id, $country_id, $pincode;
    // public $addresses = [];

    // public function mount()
    // {
    //     $user = Auth::user();
    //     $this->name   = $user->name;
    //     $this->email  = $user->email;
    //     $this->phone  = $user->phone;
    //     $this->gender = $user->gender;
    //     $this->dob    = $user->dob;

    //     $this->addresses = $user->address()->latest()->get();
    // }

    // public function updateProfile()
    // {
    //     $this->validate([
    //         'name'   => 'required|string|max:255',
    //         'email'  => 'required|email',
    //         'phone_no'  => 'nullable|string|max:20',
    //         'gender' => 'nullable|string',
    //         'dob'    => 'nullable|date',
    //         'avatar' => 'nullable|image|max:1024', // 1MB
    //     ]);

    //     $user = Auth::user();

    //     if ($this->avatar) {
    //         $path = $this->avatar->store('avatars', 'public');
    //         $user->profile_image = 'storage/' . $path;
    //     }

    //     $user->update([
    //         'name'   => $this->name,
    //         'email'  => $this->email,
    //         'phone'  => $this->phone,
    //         'gender' => $this->gender,
    //         'dob'    => $this->dob,
    //     ]);

    //     session()->flash('success', 'Profile updated successfully!');
    // }

    // public function saveAddress()
    // {
    //     $this->validate([
    //         'address_line_1' => 'required|string|max:255',
    //         'city'           => 'required|string|max:255',
    //         'state_id'       => 'required|integer',
    //         'country_id'     => 'required|integer',
    //         'pincode'        => 'required|string|max:10',
    //     ]);

    //     Auth::user()->address()->create([
    //         'address_line_1' => $this->address_line_1,
    //         'address_line_2' => $this->address_line_2,
    //         'landmark'       => $this->landmark,
    //         'city'           => $this->city,
    //         'state_id'       => $this->state_id,
    //         'country_id'     => $this->country_id,
    //         'pincode'        => $this->pincode,
    //     ]);

    //     $this->addresses = Auth::user()->address()->latest()->get();

    //     $this->reset([
    //         'address_line_1', 'address_line_2', 'landmark',
    //         'city', 'state_id', 'country_id', 'pincode'
    //     ]);

    //     session()->flash('success', 'Address added successfully!');
    // }

    // public function deleteAddress($id)
    // {
    //     $address = UserAddress::where('user_id', Auth::id())->find($id);
    //     if ($address) {
    //         $address->delete();
    //         $this->addresses = Auth::user()->address()->latest()->get();
    //     }
    // }

    // public function render()
    // {
    //     return view('livewire.account-page', [
    //         'addresses' => $this->addresses,
    //     ])->extends('frontend.layouts.app')->section('content');
    // }
//}


// namespace App\Livewire;

// use Livewire\Component;

// class AccountPage extends Component
// {
//     public function render()
//     {
//         return view('livewire.account-page');
//     }
// }
