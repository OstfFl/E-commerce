<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <style>
        nav svg{
            height: 20px;;

        }
        nav .hidden{
            display: block;
        }
    </style>
    <main class="main">
{{--        <div class="page-header breadcrumb-wrap">--}}
{{--            <div class="container">--}}
{{--                <div class="breadcrumb">--}}
{{--                    <a href="/" rel="nofollow">Glowna</a>--}}
{{--                    <span></span>Edytuj Nowy Produkt--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">Edytuj Nowy Produkt</div>
                                <div class="col-md-6"><a href="{{route('admin.products')}}" class="btn btn-success float-end">Wszystkie Produkty</a></div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(Session::has('message'))
                                <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                            @endif
                            <form wire:submit.prevent="editproduct()">
                                <div class="md-3 mt-3">
                                    <label for="name" class="form-label">Nazwa</label>
                                    <input type="text" name="name" class="form-control" placeholder="Wpisz nazwe kategorii" wire:model="name" wire:keyup="generateSlug">
                                    @error('name')
                                    <p class="text-danger">{{$message}} </p>
                                    @enderror
                                </div>
                                <div class="md-3 mt-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" name="slug" class="form-control" placeholder="Wpisz nazwe kategorii" wire:model="slug">
                                    @error('slug')
                                    <p class="text-danger">{{$message}} </p>
                                    @enderror
                                </div>
                                <div class="md-3 mt-3">
                                    <label for="short_description" class="form-label">Krotki Opis</label>
                                    <textarea class="form-control"  name="short_description" placeholder="Wpisz Krótki Opis" wire:model="short_description"></textarea>
                                    @error('short_description')
                                    <p class="text-danger">{{$message}} </p>
                                    @enderror
                                </div>
                                <div class="md-3 mt-3">
                                    <label for="description" class="form-label">Opis</label>
                                    <textarea class="form-control"  name="description" placeholder="Wpisz Opis" wire:model="description"></textarea>
                                    @error('description')
                                    <p class="text-danger">{{$message}} </p>
                                    @enderror
                                </div>
{{--                                <div class="md-3 mt-3">--}}
{{--                                    <label for="sale_price" class="form-label">Standardowa Cena</label>--}}
{{--                                    <input type="text" name="sale_price" class="form-control" placeholder="Wpisz cenę" wire:model="sale_price">--}}
{{--                                    @error('sale_price')--}}
{{--                                    <p class="text-danger">{{$message}} </p>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
                                <div class="md-3 mt-3">
                                    <label for="sale_price" class="form-label">Cena Sprzedaży</label>
                                    <input type="text" name="sale_price" class="form-control" placeholder="Wpisz cene sprzedaży" wire:model="sale_price">
                                    @error('sale_price')
                                    <p class="text-danger">{{$message}} </p>
                                    @enderror
                                </div>
                                <div class="md-3 mt-3">
                                    <label for="sku" class="form-label">SKU</label>
                                    <input type="text" name="sku" class="form-control" placeholder="Wpisz SKU" wire:model="sku">
                                    @error('sku')
                                    <p class="text-danger">{{$message}} </p>
                                    @enderror
                                </div>
                                <div class="md-3 mt-3">
                                    <label for="stock_status" class="form-label" >Status</label>
                                    <select class="form-control" wire:model="stock_status">
                                        <option value="instock">Instock</option>
                                        <option value="outofstock">Out Of Stock</option>
                                    </select>
                                    @error('stock_status')
                                    <p class="text-danger">{{$message}} </p>
                                    @enderror
                                </div>
{{--                                <div class="md-3 mt-3">--}}
{{--                                    <label for="featured" class="form-label" >Wyróżniony</label>--}}
{{--                                    <select class="form-control" name="featured" wire:model="featured">--}}
{{--                                        <option value="0">Nie</option>--}}
{{--                                        <option value="1">Tak</option>--}}
{{--                                    </select>--}}
{{--                                    @error('featured')--}}
{{--                                    <p class="text-danger">{{$message}} </p>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
                                <div class="md-3 mt-3">
                                    <label for="quantity" class="form-label" >Ilosc</label>
                                    <input type="text" name="quantity" class="form-control" placeholder="Wpisz ilosc" wire:model="quantity">
                                    @error('quantity')
                                    <p class="text-danger">{{$message}} </p>
                                    @enderror
                                </div>
                                <div class="md-3 mt-3">
                                    <label for="image" class="form-label">Zdjęcie</label>
                                    <input type="text" name="image" class="form-control" placeholder="{{$image}}" wire:model="newimage" />
                                    @if($newimage)
                                        <img src="{{$newimage}}" width="120" />
                                    @else
                                        <img src="{{$image}}" width="120" />
                                    @endif
                                    @error('newimage')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>


                                <div class="md-3 mt-3">
                                    <label for="category_id" class="form-label">Kategoria</label>
                                    <select class="form-control" name="category_id" wire:model="category_id">
                                        <option value="">Wybierz Kategorię</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <p class="text-danger">{{$message}} </p>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary float-end">Aktualizuj</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
