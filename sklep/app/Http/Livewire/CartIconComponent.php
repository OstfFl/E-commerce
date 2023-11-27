<?php

namespace App\Http\Livewire;

use App\Models\ProductImages;
use Livewire\Component;

class CartIconComponent extends Component
{
    protected $listeners = ['refreshComponent'=>'$refresh'];
    public function render()
    {
        $images=ProductImages::get();
        return view('livewire.cart-icon-component',['images'=>$images]);
    }
}
