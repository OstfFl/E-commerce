<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <main class="main">
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            @if(Session::has('success_message'))
                                <div class="alert alert-success">
                                    <strong>Success | {{Session::get('success_message')}}</strong>
                                </div>
                            @endif
                            @if(Cart::instance('cart')->count() > 0)
                                <table class="table shopping-summery text-center clean">
                                    <thead>
                                    <tr class="main-heading">
                                        <th scope="col">Zdjęcie</th>
                                        <th scope="col">Nazwa</th>
                                        <th scope="col">Cena</th>
                                        <th scope="col">Iłość</th>
                                        <th scope="col">Wartość razem</th>
                                        <th scope="col">Usuń</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach(Cart::instance('cart')->content() as $item)
                                        <tr>
                                            <td class="image product-thumbnail"><img
                                                    src="{{ $images->where('product_id', $item->model->id)->first()->image}}"
                                                    alt="#"></td>
                                            <td class="product-des product-name">
                                                <h5 class="product-name"><a
                                                        href="product-details.html">{{$item->model->name}}</a></h5>

                                            </td>
                                            <td class="price" data-title="Price">
                                                <span>${{$item->model->sale_price}} </span></td>
                                            <td class="text-center" data-title="Stock">
                                                <div class="detail-qty border radius  m-auto">
                                                    <a href="#" class="qty-down"
                                                       wire:click.prevent="decreaseQuantity('{{$item->rowId}}')"><i
                                                            class="fi-rs-angle-small-down"></i></a>
                                                    <span class="qty-val">{{$item->qty}}</span>
                                                    <a href="#" class="qty-up"
                                                       wire:click.prevent="increaseQuantity('{{$item->rowId}}')"><i
                                                            class="fi-rs-angle-small-up"></i></a>
                                                </div>
                                            </td>
                                            <td class="text-right" data-title="Cart">
                                                <span>${{$item->subtotal}} </span>
                                            </td>
                                            <td class="action" data-title="Remove"><a href="#" class="text-muted"
                                                                                      wire:click.prevent="destroy('{{$item->rowId}}')"><i
                                                        class="fi-rs-trash"></i></a></td>
                                        </tr>
                                    @endforeach


                                    <tr>
                                        <td colspan="6" class="text-end">
                                            <a href="#" class="text-muted" wire:click.prevent="clearALL()"> <i
                                                    class="fi-rs-cross-small"></i> Clear Cart</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            @else
                                <p>Pusto</p>
                            @endif
                        </div>
                        <div class="cart-action text-end">
                            <a class="btn  mr-10 mb-sm-15" onclick="location.reload()"><i
                                    class="fi-rs-shuffle mr-10"></i>Wznów</a>
                            <a class="btn " href="{{route('shop')}}"><i class="fi-rs-shopping-bag mr-10"></i>Kontynuj
                                Zakupy
                            </a>
                        </div>
                        <div class="divider center_icon mt-50 mb-50"><i class="fi-rs-fingerprint"></i></div>
                        <div class="row mb-50">
                            <div class="col-lg-6 col-md-12">
                                <div class="heading_s1 mb-3">

                                </div>

                                <div class="mb-30 mt-50">
                                    <div class="heading_s1 mb-3">
                                        <h4>Dodaj Kupon</h4>
                                    </div>
                                    <div class="total-amount">
                                        <div class="left">
                                            <div class="coupon">
                                                <form action="#" target="_blank">
                                                    <div class="form-row row justify-content-center">
                                                        <div class="form-group col-lg-6">
                                                            <input class="font-medium" name="Coupon"
                                                                   placeholder="Wpisz Kupon">
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <button class="btn  btn-sm"><i
                                                                    class="fi-rs-label mr-10"></i>Dodaj
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="border p-md-4 p-30 border-radius cart-totals">
                                    <div class="heading_s1 mb-3">
                                        <h4>Posumowanie Koszas</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td class="cart_total_label">Suma</td>
                                                <td class="cart_total_amount"><span
                                                        class="font-lg fw-900 text-brand">${{Cart::subtotal()}}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="cart_total_label">Podatek</td>
                                                <td class="cart_total_amount"><span
                                                        class="font-lg fw-900 text-brand">${{Cart::tax()}}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="cart_total_label">Dostawa</td>
                                                <td class="cart_total_amount"><i class="ti-gift mr-5"></i> Bezpłatnie
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="cart_total_label">Podsumowanie</td>
                                                <td class="cart_total_amount"><strong><span
                                                            class="font-xl fw-900 text-brand">${{Cart::total()}}</span></strong>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    @auth
                                        @if(Auth::user()->utype == 'USR')
                                            <a href="{{route('shop.checkout')}}" class="btn "> <i
                                                    class="fi-rs-box-alt mr-10"></i>Przejdź do opłaty
                                            </a>
                                        @else
                                            <a href="/" class="btn "> <i class="fi-rs-box-alt mr-10"></i>Glowna
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
