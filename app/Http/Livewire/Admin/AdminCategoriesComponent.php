<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCategoriesComponent extends Component
{
    public $category_id;

    public function deleteCategory($id){
        $category = Category::find($id);
        unlink('material/category/'.$category->image);
        $category->delete();
        session()->flash('message','Category has been deleted successfully!');
    }

    use WithPagination;
    public function render()
    {
        $categories = Category::orderBy('name','ASC')->paginate(5);
        return view('livewire.admin.admin-categories-component',['categories'=>$categories]);
    }
}
