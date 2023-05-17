<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Livewire\Component;
use Livewire\WithPagination;
class AdminHomeSliderComponent extends Component
{
    use WithPagination;
    public  $slide_id;
    public function deleteSlide($id){
    $slide =HomeSlider::find($id);
    unlink('material/sliders/'.$slide->image);
    // unlink('material/Demo/'.$product->PDF_demo);
    // unlink('material/Full/'.$product->PDF_full);
    $slide->delete();
    session()->flash('message','slide has been deleted!');
    }
    public function render()
    {
     
        $slides = HomeSlider::orderBy('created_at','DESC')->get();
        return view('livewire.admin.admin-home-slider-component',['slides'=>$slides]);
    }
}
