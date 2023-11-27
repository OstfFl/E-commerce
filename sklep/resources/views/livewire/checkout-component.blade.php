<div>
    {{-- Success is as dangerous as failure. --}}
    <main class="main">
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">

                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="divider mt-50 mb-50"></div>
                    </div>
                </div>
                @if(Cart::instance('cart')->count() > 0)
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-25">
                            <h4>Dane Klienta</h4>
                        </div>

                        @if(Session::has('message'))
                            <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                        @endif
                        <form wire:submit.prevent="storeOrder()">
                            <div class="form-group">
                                <input type="text"   name="firstName" placeholder="First name *" wire:model="firstName">
                                @error('firstName')
                                <p class="text-danger">{{$message}} </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text"   name="lastName" placeholder="Last name * " wire:model="lastName">
                                @error('lastName')
                                <p class="text-danger">{{$message}} </p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="text" name="adres"   placeholder="Address *" wire:model="adres">
                                @error('adres')
                                <p class="text-danger">{{$message}} </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input   type="text" name="city" placeholder="City / Town *" wire:model="city">
                                @error('city')
                                <p class="text-danger">{{$message}} </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input   type="text" name="country" placeholder="State / County *" wire:model="country">
                                @error('country')
                                <p class="text-danger">{{$message}} </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input   type="text" name="postCode" placeholder="Postcode / ZIP *" wire:model="postCode">
                                @error('postCode')
                                <p class="text-danger">{{$message}} </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input   type="text" name="phone" placeholder="Phone *" wire:model="phone">
                                @error('phone')
                                <p class="text-danger">{{$message}} </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input   type="text" name="email" placeholder="Email address *" wire:model="email">
                                @error('email')
                                <p class="text-danger">{{$message}} </p>
                                @enderror
                            </div><div class="bt-1 border-color-1 mt-30 mb-30"></div>
{{--                                <div class="mb-25">--}}
{{--                                    <h5>Payment</h5>--}}
{{--                                </div>--}}
{{--                                <div class="payment_option">--}}
{{--                                    <div class="custome-radio">--}}
{{--                                        <input class="form-check-input"   type="radio"  id="exampleRadios3">--}}
{{--                                        <label class="form-check-label" for="exampleRadios3"  data-target="#cashOnDelivery" aria-controls="cashOnDelivery">Cash On Delivery</label>--}}
{{--                                    </div>--}}
{{--                                    <div class="custome-radio">--}}
{{--                                        <input class="form-check-input"   type="radio"  id="exampleRadios4">--}}
{{--                                        <label class="form-check-label" for="exampleRadios4"  data-target="#cardPayment" aria-controls="cardPayment">Pay U</label>--}}
{{--                                    </div>--}}
{{--                                    <div class="custome-radio">--}}
{{--                                        <input class="form-check-input"   type="radio"  id="exampleRadios5">--}}
{{--                                        <label class="form-check-label" for="exampleRadios5"  data-target="#paypal" aria-controls="paypal">Paypal</label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            <button type="submit" class="btn btn-primary float-end">Zatwierdź</button>

                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="order_review">
                            <div class="mb-20">
                                <h4>Twoje zamówienie</h4>
                            </div>
                            <div class="table-responsive order_table text-center">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th colspan="2">Produkt</th>
                                        <th>Razem</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(Cart::instance('cart')->content() as $item)
                                    <tr>
                                        <td class="image product-thumbnail"><img src="{{ $images->where('product_id', $item->model->id)->first()->image }}" alt="#"></td>
                                        <td>
                                            <h5><a href="/">{{$item->model->name}}</a> <span class="product-qty">x {{$item->qty}}</span></h5>
                                        </td>
                                        <td>${{$item->subtotal}}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <th>Suma za Towar</th>
                                        <td class="product-subtotal" colspan="2">${{Cart::subtotal()}}</td>
                                    </tr>
                                    <tr>
                                        <th>Dostawa</th>
                                        <td colspan="2"><em>Bezpłatna dostawa</em></td>
                                    </tr>
                                    <tr>
                                        <th>Ogółem</th>
                                        <td colspan="2" class="product-subtotal"><span class="font-xl text-brand fw-900">${{Cart::total()}}</span></td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>

                </div>
                @else
                    <p>Pusto</p>
                @endif

            </div>
        </section>
    </main>
</div>
