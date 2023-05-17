<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AdminEditProductComponent extends Component
{
    use WithFileUploads;
    public $product_id;
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
    public $newimage;
    public $newpdfdemo;
    public $newpdfful;

    public function mount($product_id){
        $product = Product::find($product_id);

        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->short_description = $product->short_description;
        $this->description = $product->description;
        $this->regular_price = $product->regular_price;
        $this->sale_price = $product->sale_price;
        $this->sku = $product->SKU;
        $this->featured = $product->featured;
        $this->image = $product->image;
        $this->PDF_demo = $product->PDF_demo;
        $this->PDF_full = $product->PDF_full;
        $this->category_id = $product->category_id;
    }
    public function generateSlug(){
        $this->slug = Str::slug($this->name);
    }
    public function updateProduct(){
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
        $product = Product::find($this->product_id);
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->SKU = $this->sku;
        $product->featured = $this->featured;

        if($this->newimage){
            unlink('material/imges/'.$product->image);
            $imageName = Carbon::now()->timestamp.'.'.$this->newimage->extension();
            $this->newimage->storeAs('imges',$imageName);
            $product->image = $imageName;
        }
        if($this->newpdfdemo){
            unlink('material/Demo/'.$product->PDF_demo);
            $PDF_demoName = Carbon::now()->timestamp.'.'.$this->newpdfdemo->extension();
            $this->newpdfdemo->storeAs('Demo',$PDF_demoName);
            $product->PDF_demo = $PDF_demoName;
        }
        if($this->newpdfful){
            unlink('material/Full/'.$product->PDF_full);
            $PDF_fullName = Carbon::now()->timestamp.'.'.$this->newpdfful->extension();
            $this->newpdfful->storeAs('Full',$PDF_fullName);
            $product->PDF_full = $PDF_fullName;
        }
        
        $product->category_id = $this->category_id;
        $product->save();
        session()->flash('message','Product has been updated!');
    }
    public function render()
    {
        $categories =Category::orderBy('name','ASC')->get();
        return view('livewire.admin.admin-edit-product-component',['categories'=>$categories]);
    }
}
