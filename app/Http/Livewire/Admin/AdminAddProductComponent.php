<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
class AdminAddProductComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $short_description;
    public $description;
    public $regular_price;
    public $sale_price;
    public $sku;
    public $featured = 0;
    public $image;
    public $PDF_demo;
    public $PDF_full;
    public $category_id;

    public function generateSlug(){
        $this->slug = Str::slug($this->name);
    }
    public function addProduct(){
        $this->validate([
            'name'=>'required',
            'slug'=>'required',
            'short_description'=>'required',
            'description'=>'required',
            'regular_price'=>'required',
            'sale_price'=>'required',
            'sku'=>'required',
            'featured'=>'required',
            'image'=>'required',
            'PDF_demo'=>'required',
            'PDF_full'=>'required',
            'category_id'=>'required'
        ]);
        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->SKU = $this->sku;
        $product->featured = $this->featured;
        $imageName = Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('imges',$imageName);
        $product->image = $imageName;
        $PDF_demoName = Carbon::now()->timestamp.'.'.$this->PDF_demo->extension();
        $this->PDF_demo->storeAs('Full',$PDF_demoName);
        $product->PDF_demo = $PDF_demoName;
        $PDF_fullName = Carbon::now()->timestamp.'.'.$this->PDF_full->extension();
        $this->PDF_full->storeAs('Demo',$PDF_fullName);
        $product->PDF_full = $PDF_fullName;
        $product->category_id = $this->category_id;
        $product->save();
        session()->flash('message','Product has been added!');
    }
    public function render()
    {
        $categories =Category::orderBy('name','ASC')->get();
        return view('livewire.admin.admin-add-product-component',['categories'=>$categories]);
    }
}
