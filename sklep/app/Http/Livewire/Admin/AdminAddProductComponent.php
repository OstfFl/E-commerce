<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\ProductImages;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
class AdminAddProductComponent extends Component
{
    use WithFileUploads;
    public $product_id;
    public $name;
    public $slug;
    public $short_description;
    public $description;
    public $sale_price;
//    public $sale_price;
    public $sku;
    public $stock_status='instock';

    public $featured=0;
    public $quantity;
    public $image;
    public $category_id;

    public function generateSlug(){
        $this->slug=Str::slug($this->name);
    }
    public function addproduct(){
        $this->validate([
            'name'=>['required','regex:/^[A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłóńśźż]+\s?[A-ZĄĆĘŁŃÓŚŹŻ]?[a-ząćęłóńśźż]+$/u'],
            'slug'=>'required',
            'short_description'=>['required','regex:/^[A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]+([\s][a-ząćęłńóśźż]+)*$/u'],
            'description'=>['required','regex:/^[A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]+([\s][a-ząćęłńóśźż]+)*$/u'],
            'sale_price'=>['required','regex:/^\d+(?:\.\d{2})?$/u'],

            'sku'=>'required',
            'stock_status'=>'required',

            'quantity'=>'required',
            'image'=>'required',
            'category_id'=>'required'
        ],
        [
            'name'=>['required'=>'Musisz wpisać nazwę produktu!',
                     'regex'=>'Imie musi zaczynać się z dużej litery oraz zawierać polskie symbole!'],
            'short_description'=>['required'=>'Musisz podac krótki opis',
                                   'regex'=>'Musi zaczynać sie z dużej litery!'],
            'description'=>['required'=>'Musisz podac opis',
                            'regex'=>'Musi zaczynać sie z dużej litery!'],
            'sale_price'=>['required'=>'Wymagana cena!',
                                'regex'=>'Wymagany poprawny format ceny!'],

            'sku'=>['required'=>'Wymagany SKU!'],
            'stock_status'=>['required'=>'Wymagane pole!'],

            'quantity'=>['required'=>'Wymagane pole!'],
            'image'=>['required'=>'Wymagane pole!'],
            'category_id'=>['required'=>'Wymagane pole!']
        ]



        );
        $nameExists = DB::table('products')->where('name', $this->name)->exists();
        if ($nameExists) {
            session()->flash('error', 'Produkt już istnieje w bazie danych!');
            return;
        }
        $product=new Product();
        $productDetails=new ProductDetails();
        $productImage=new ProductImages();
        $product->name=$this->name;
        $product->slug=$this->slug;
        $productDetails->short_description=$this->short_description;
        $productDetails->description=$this->description;
        $product->sale_price=$this->sale_price;
        $product->sku=$this->sku;
        $product->stock_status=$this->stock_status;
        $product->quantity=$this->quantity;
        $productImage->image=$this->image;


        $product->category_id=$this->category_id;
        $product->save();
        $productDetails->product_id=$product->id;
        $productImage->product_id=$product->id;
        $productDetails->save();
        $productImage->save();
        session()->flash('message','Produkt Dodany!');
    }
    public function render()
    {
        $categories=Category::orderBy('name','ASC')->get();
        return view('livewire.admin.admin-add-product-component',['categories'=>$categories]);
    }
}
