<?php

namespace App\Http\Livewire;

use App\Models\ProductImages;
use Livewire\Component;
use Cart;
class WishlistComponent extends Component
{
    public function remoweFromWishlist($product_id)
    {
        foreach (Cart::instance('wishlist')->content() as $witem) {
            if ($witem->id == $product_id) {
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('wishlist-icon-component', 'refreshComponent');
                return;
            }
        }

    }
    public function render()
    {
        $images=ProductImages::get();
        return view('livewire.wishlist-component',['images'=>$images]);
    }
}
