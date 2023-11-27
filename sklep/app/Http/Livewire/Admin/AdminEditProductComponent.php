<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\ProductImages;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminEditProductComponent extends Component
{
    use WithFileUploads;
    public $product_id;
    public $name;
    public $slug;
    public $short_description_id;
    public $description_id;
    public $image_id;
    public $short_description;
    public $description;
    public $sale_price;

    public $sku;
    public $stock_status='instock';

    public $featured=0;
    public $quantity;
    public $image;
    public $category_id;
    public $newimage;

    public function mount($product_id){
        $product=Product::find($product_id);
        $product->product_id=$this->product_id;
        $this->description_id=$product->product_details_id;
        $this->image_id=$product->product_images_id;

        $productDetails=ProductDetails::find($this->product_id);
        $images=ProductImages::find($this->product_id);

        $this->name=$product->name;
        $this->slug=$product->slug;

        $this->short_description=$productDetails->short_description;
        $this->description=$productDetails->description;

        $this->sale_price=$product->sale_price;
        $this->sku=$product->sku;
        $this->stock_status=$product->stock_status;
        $this->quantity=$product->quantity;

        $this->image=$images->image;

        $this->category_id=$product->category_id;
    }

    public function generateSlug(){
        $this->slug=Str::slug($this->name);
    }
    public function editproduct(){
        $this->validate([
            'name'=>['required'],
            'slug'=>'required',
            'short_description'=>['required'],
            'description'=>['required'],
            'sale_price'=>['required','regex:/^\d+(?:\.\d{2})?$/u'],
//            'sale_price'=>['required','regex:/^\d+(?:\.\d{2})?$/u'],
            'sku'=>'required',
            'stock_status'=>'required',
//            'featured'=>'required',
            'quantity'=>'required',
            'image'=>'required',
            'category_id'=>'required'
        ],
            [
                'name'=>['required'=>'Musisz wpisać nazwę produktu!', 'regex'=>'Imie musi zaczynać się z dużej litery oraz zawierać polskie symbole!'],
                'short_description'=>['required'=>'Musisz podac krótki opis',
                    ],
                'description'=>['required'=>'Musisz podac opis',
                    ],
                'sale_price'=>['required'=>'Wymagana cena!',
                    'regex'=>'Wymagany poprawny format ceny!'],
//                'sale_price'=>['required'=>'Wymagana cena!',
//                    'regex'=>'Wymagany poprawny format ceny!'],
                'sku'=>['required'=>'Wymagany SKU!'],
                'stock_status'=>['required'=>'Wymagane pole!'],
//                'featured'=>['required'=>'Wymagane pole!'],
                'quantity'=>['required'=>'Wymagane pole!'],
                'image'=>['required'=>'Wymagane pole!'],
                'category_id'=>['required'=>'Wymagane pole!']
            ]);
        $product = Product::find($this->product_id);



        $details=ProductDetails::find($this->product_id);
        $images=ProductImages::find($this->product_id);

        $product->name=$this->name;
        $product->slug=$this->slug;
        $details->short_description=$this->short_description;
        $details->description=$this->description;

        $product->sale_price=$this->sale_price;
        $product->sku=$this->sku;
        $product->stock_status=$this->stock_status;

        $product->quantity=$this->quantity;
        if($this->newimage) {
            $images->image = $this->newimage;
        }else{
            $images->image = $this->image;
        }
        $product->category_id=$this->category_id;

        $product->save();
        $details->save();
        $images->save();
        session()->flash('message','Produkt Aktualizowany!');
    }
    public function render()
    {
        $categories=Category::orderBy('name','ASC')->get();
        return view('livewire.admin.admin-edit-product-component',['categories'=>$categories]);
    }
}
