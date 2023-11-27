<div>
    <style>
        nav svg {
            height: 20px;
        }

        nav .hidden {
            display: block;
        }
        .wishlisted{
            background-color: #F15412 !important;
            border:1px solid transparent !important;
        }
        .wishlisted i{
            color:#fff !important;
        }
        .product-cart-wrap .product-action-1 button:after, .product-cart-wrap .product-action-1 a.action-btn:after {
            left: -32%;
        }

    </style>
    <main class="main">
{{--        <div class="page-header breadcrumb-wrap">--}}
{{--            <div class="container">--}}
{{--                <div class="breadcrumb">--}}
{{--                    <a href="/" rel="nofollow">Home</a>--}}
{{--                    <span></span> Wishlist--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row product-grid-4">
                    @foreach(Cart::instance('wishlist')->content() as $item)

                        <div class="col-lg-3 col-md-3 col-6 col-sm-6">
                            <div class="product-cart-wrap mb-30">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="{{route('product.details',['slug'=>$item->model->slug])}}">
                                            <img class="default-img"
                                                 src="{{ $images->where('product_id', $item->model->id)->first()->image}}"
                                                 alt="{{$item->model->name}}">
                                            <img class="hover-img"
                                                 src="{{ $images->where('product_id', $item->model->id)->first()->image}}"
                                                 alt="{{$item->model->name}}">
                                        </a>
                                    </div>
                                    <div class="product-action-1">

                                    </div>
                                    <div class="product-badges product-badges-position product-badges-mrg">

                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">

                                    </div>
                                    <h2><a href="{{route('product.details',['slug'=>$item->model->slug])}}">{{$item->model->name}}</a></h2>
                                    <div class="rating-result" title="90%">
                                            <span>

                                            </span>
                                    </div>
                                    <div class="product-price">
                                        <span>${{$item->model->sale_price}} </span>
                                        {{--  <span class="old-price">$245.8</span>--}}
                                    </div>
                                    <div class="product-action-1 show">

                                            <a aria-label="Usuń" class="action-btn hover-up wishlisted"
                                               href="#" wire:click.prevent="remoweFromWishlist({{$item->model->id}})"><i class="fi-rs-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
</div>
