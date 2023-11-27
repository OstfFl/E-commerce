<?php

namespace App\Http\Livewire;

use App\Models\orders;
use App\Models\ProductImages;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
class CheckoutComponent extends Component
{
      public  $firstName;
      public  $lastName;
      public  $adres;
      public  $city;
      public  $country;
      public  $postCode;
      public  $phone;
      public  $email;
      public  $productIds=[];

//      public function updated($fields){
//          $this->validateOnly($fields,[
//              'firstName'=>'required',
//              'lastName'=>'required',
//              'adres'=>'required',
//              'city'=>'required',
//              'country'=>'required',
//              'postCode'=>'required',
//              'phone'=>'required',
//              'email'=>'required',
////              'productId'=>'required',
////              'productId'=>'required',
//          ]);
//      }
      public function storeOrder(){
          $cartItems = Cart::instance('cart')->content();
          $productIds = implode(',', $cartItems->pluck('id')->toArray());
          $this->validate([

              'firstName'=>['required','regex:/^[A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]+\s?([A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]+)?$/u'],
              'lastName'=>['required','regex:/^[A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]+\s?([A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]+)?$/u'],
              'adres'=>['required','regex:/^[A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]+([\s][A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]+)*$/u'],
              'city'=>['required','regex:/^[A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]+([\s][A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]+)*$/u'],
              'country'=>['required','regex:/^[A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]+([\s][A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]+)*$/u'],
              'postCode'=>['required','regex:/^\d+(-[0-9]+)*$/'],
              'phone'=>['required','regex:/^\+[0-9]+$/'],
              'email'=>['required','regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],],
              [
                  'firstName'=>['required'=>'Wymagane Pole!','regex'=>'Musi spełniać warunki, np, zaczynać się od Dużej litery'],
                  'lastName'=>['required'=>'Wymagane Pole!','regex'=>'Musi spełniać warunki, np, zaczynać się od Dużej litery'],
                  'adres'=>['required'=>'Wymagane Pole!','regex'=>'Musi spełniać warunki, np, zaczynać się od Dużej litery'],
                  'city'=>['required'=>'Wymagane Pole!','regex'=>'Musi spełniać warunki, np, zaczynać się od Dużej litery'],
                  'country'=>['required'=>'Wymagane Pole!','regex'=>'Musi spełniać warunki, np, zaczynać się od Dużej litery'],
                  'postCode'=>['required'=>'Wymagane Pole!','regex'=>'Musi spełniać warunki dla Kodu Pocztowego! Np: 20-501'],
                  'phone'=>['required'=>'Wymagane Pole!','regex'=>'Musi spełniać warunki, np, +48730941662'],
                  'email'=>['required'=>'Wymagane Pole!','regex'=>'Musi spełniać warunki, np, imie@email.com']
              ]
          );
          $order=new orders();
          $order->firstName=$this->firstName;;
          $order->lastName=$this->lastName;;
          $order->adres=$this->adres;;
          $order->city=$this->city;;
          $order->country=$this->country;;
          $order->postCode=$this->postCode;;
          $order->phone=$this->phone;;
          $order->email=$this->email;;
          $order->productIds=$productIds;
          $order->save();
          session()->flash('message','Zamowienie dodano!');
      }
    public function render()
    {
        $images=ProductImages::get();
        return view('livewire.checkout-component',['images'=>$images]);
    }
}
