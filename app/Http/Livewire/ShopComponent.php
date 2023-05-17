<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use Illuminate\Support\Facades\Auth;

class ShopComponent extends Component
{  
    use WithPagination;
    public $pageSize = 12;
    public $orderBy = "Default Sorting";
    
    public function store($product_id, $product_name, $product_price)
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
    public function changePageSize($size){
        $this->pageSize = $size;
    }

    public function changeOrderBy($order){
        $this->orderBy = $order;
    }
    public function render()
    {
        if(Auth::check())
        {
            Cart::instance('cart')->store(Auth::user()->email);
        }
        else {
            return view('auth.login_cart');;
        }
        if($this->orderBy == 'Price: Low to High'){
            $products = Product::orderBy('regular_price','ASC')->paginate($this->pageSize);
        }else if ($this->orderBy == 'Price: High to Low'){
            $products = Product::orderBy('regular_price','DESC')->paginate($this->pageSize);
        }else if ($this->orderBy == 'Sort By Newness'){
            $products = Product::orderBy('created_at','DESC')->paginate($this->pageSize);

        }else{
            $products = Product::paginate($this->pageSize);
        }
        $categories = Category::orderBy('name','ASC')->get();
        $nproducts = Product::orderby('created_at','DESC')->get()->take(3);
        
        return view('livewire.shop-component', [
            'products' => $products,
            'categories' => $categories,
            'nproducts' => $nproducts, // fixed syntax error here
        ]);
    }
}
