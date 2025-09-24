<?php

namespace App\Livewire\Account;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;

class ProfilePage extends Component
{
    public $name, $email, $phone_no;

    public function mount()
    { 

        $user = Auth::user();
       $this->name     = $user->name;
        $this->email    = $user->email;
        $this->phone_no = $user->phone_no;
    
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string',
            'phone_no' => 'nullable|string|max:20',
           
        ]);

        Auth::user()->update([
            'name' => $this->name,
            'phone_no' => $this->phone_no,
           
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
