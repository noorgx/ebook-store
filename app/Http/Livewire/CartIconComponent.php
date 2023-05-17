<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Cart;
class CartIconComponent extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];
    public function render()
    {
        if (Auth::check()) {
            Cart::instance('cart')->store(Auth::user()->email);
        }
        return view('livewire.cart-icon-component');
    }
}
