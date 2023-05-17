<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductComponent extends Component
{
    use WithPagination;
    public  $product_id;
    public function deleteProduct($id){
        $product =Product::find($id);
        // unlink('material/imges/'.$product->image);
        // unlink('material/Demo/'.$product->PDF_demo);
        // unlink('material/Full/'.$product->PDF_full);
        $product->delete();
        session()->flash('message','Product has been deleted!');
    }
    public function render()
    {
        $products = Product::orderBy('created_at','DESC')->paginate(10);
        return view('livewire.admin.admin-product-component',['products'=>$products]);
    }
}
