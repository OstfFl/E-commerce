<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImages;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Cart;

class SearchComponent extends Component
{
    use WithPagination;

    public $pageSize = 12;
    public $orderBy = "Default Sorting";
    public $min_value = 0;
    public $max_value = 10000;
    public $q;
    public $search_term;
    public function mount(){
        $this->fill(request()->only('q'));
        $this->search_term='%'.$this->q.'%';
    }
    public function store($product_id, $product_name, $product_price)
    {

        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('\App\Models\Product');
        session()->flash('success_message', 'Item Added To Cart');
        $this->emitTo('cart-icon-component','refreshComponent');
        return redirect()->route('shop.cart');
    }

    public function changePageSize($size)
    {
        $this->pageSize = $size;
    }

    public function ChangeOrderBy($order)
    {
        $this->orderBy = $order;
    }
    public function addToWishlist($product_id, $product_name, $product_price)
    {
        \Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
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
        if ($this->orderBy == 'Price: Low to High') {
            $products = Product::whereBetween('sale_price', [$this->min_value, $this->max_value])->where('name','like',$this->search_term)->orderBy('sale_price', 'ASC')->paginate($this->pageSize);
        } elseif ($this->orderBy == 'Price: High to Low') {
            $products = Product::whereBetween('sale_price', [$this->min_value, $this->max_value])->where('name','like',$this->search_term)->orderBy('sale_price', 'DESC')->paginate($this->pageSize);
        } elseif ($this->orderBy == 'Sort by Newest') {
            $products = Product::whereBetween('sale_price', [$this->min_value, $this->max_value])->where('name','like',$this->search_term)->orderBy('created_at', 'DESC')->paginate($this->pageSize);
        } else {
            $products = Product::whereBetween('sale_price', [$this->min_value, $this->max_value])->where('name','like',$this->search_term)->paginate($this->pageSize);
        }

        $categories = Category::orderBy('name', 'ASC')->get();
        $images=ProductImages::get();
        return view('livewire.search-component', ['products' => $products,'images'=>$images,'categories'=>$categories]);
    }
}
