<?php

namespace App\Livewire\Account;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class OrderPage extends Component
{
    public function render()
    {
        $orders = Auth::user()->order()->with('child.product')->latest()->get();

        return view('livewire.account.order-page', compact('orders'))
            ->extends('frontend.layouts.app')
            ->section('content');
    }
}

