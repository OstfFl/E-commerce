<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\ProductImages;
use Livewire\Component;
use Cart;
class DetailsComponent extends Component
{
    public $slug;
    public $min_value = 0;
    public $max_value = 1000;
    public function mount($slug)
    {
        $this->slug = $slug;
    }
    public function store($product_id,$product_name,$product_price){
        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('\App\Models\Product');
        session()->flash('success_message','Item Added To Cart');
        return redirect()->route('shop.cart');
    }
    public function addToWishlist($product_id, $product_name, $product_price)
    {
        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        $this->emitTo('wishlist-icon-component', 'refreshComponent');
    }
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
        $product = Product::where('slug', $this->slug)->first();

        $detail=ProductDetails::where('id',$product->id)->first();
        $image=ProductImages::where('id',$product->id)->first();
        $rproducts=Product::where('category_id',$product->category_id)->inRandomOrder()->limit(4)->get();
        $nproducts =Product::latest()->take(4)->get();
        $categories = Category::orderBy('name', 'ASC')->get();
        $images=ProductImages::get();
        return view('livewire.details-component', ['product' => $product,'detail'=>$detail,'image'=>$image,'rproducts'=>$rproducts,'images'=>$images,'nproducts'=>$nproducts,'categories' => $categories]);
    }
}
