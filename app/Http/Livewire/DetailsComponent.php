<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Cart;

class DetailsComponent extends Component
{
    public $slug;
    public function mount($slug){
        $this->slug = $slug;
    }
    public function store($product_id,$product_name,$product_price)
    {
        if (Auth::check()) {
            Cart::instance('cart')->store(Auth::user()->email);
        }
        else {
            return redirect()->route('login');
        }
        $cartItem = Cart::instance('cart')->content()->where('id', $product_id)->first();
        $books=Auth::user()->books;
        $boo= json_decode($books, true); // Convert the JSON string to an array
        
        // dd(collect($books)->contains($cartItem));
        if(collect($boo)->contains('product_id', $product_id)){
            session()->flash('success_message', 'Book already Bought');
            return redirect()->route('home.index');
        }else{
            if (!$cartItem) {
                // dd($cartItem);
                Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
                
                session()->flash('success_message', 'Book added in Cart');
            } else {
                session()->flash('success_message', 'Book already in Cart');
            }
        }
        
        return redirect()->route('shop.cart');
    }
    public function render()
    {
        $product = Product::where('slug',$this->slug)->first();
        $rproducts = Product::where('category_id',$product->category_id)->inRandomOrder()->limit(4)->get();
        $nproducts = Product::latest()->take(4)->get();

        return view('livewire.details-component',['product'=>$product,'rproducts'=>$rproducts,'nproducts'=>$nproducts]);
    }
}
