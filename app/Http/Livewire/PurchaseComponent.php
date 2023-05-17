<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PurchaseComponent extends Component
{
    public $bookId;

    public function mount($bookId)
    {
        $this->bookId = $bookId;
    }
    

    public function purchase()
    {
        $user = Auth::user();
        $book = Product::find($this->bookId);
        $price = $book->price;

        $purchase = new Purchase([
            'user_id' => $user->id,
            'book_id' => $this->bookId,
            'price' => $price,
        ]);

        $purchase->save();

        session()->flash('message', 'Purchase successful.');
    }
    public function render()
    {
        return view('livewire.purchase-component');
    }
}
