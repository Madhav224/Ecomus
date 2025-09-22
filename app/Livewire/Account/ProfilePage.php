<?php

namespace App\Livewire\Account;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProfilePage extends Component
{
    public $name, $email, $phone_no, $gender, $dob, $pincode;

    public function mount()
    {
        $user = Auth::user();
       $this->name     = $user->name;
        $this->email    = $user->email;
        $this->phone_no = $user->phone_no;
        $this->gender   = $user->gender;
        $this->dob      = $user->dob;
        $this->pincode  = $user->pincode;
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

    public function render()
    {
        return view('livewire.account.profile-page')
            ->extends('frontend.layouts.app')
            ->section('content');
    }
}
