<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;
use Illuminate\Support\Facades\Auth;

class CartComponent extends Component
{
    public function destroy($rowId)
    {
        $cart = Cart::instance('cart')->content()->where('rowId', $rowId)->first();
        if($cart){
            Cart::remove($cart->rowId);
            $this->emit('cart-icon-component','refreshComponent');
            session()->flash('success_message','Item has been removed!');
        }
    }
    public function clearAll(){
        Cart::instance('cart')->content();
        Cart::destroy();
        $this->emit('cart-icon-component','refreshComponent');
    }
    public function render()
    {
     
        if(Auth::check()){
            
            Cart::instance('cart')->store(Auth::user()->email);
        }
        else {
            
            return view('auth.login_cart');
            
        }
        return view('livewire.cart-component');
    }
}
