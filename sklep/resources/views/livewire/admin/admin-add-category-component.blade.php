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
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">Dodaj Nową Kategorię</div>
                                <div class="col-md-6"><a href="{{route('admin.categories')}}" class="btn btn-success float-end">Wszystkie Kategorie</a></div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(Session::has('message'))
                                <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                            @endif
                                @if(Session::has('error'))
                                    <div class="alert alert-danger" role="alert">{{Session::get('error')}}</div>
                                @endif
                            <form wire:submit.prevent="storeCategory()">
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
                                <button type="submit" class="btn btn-primary float-end">Zatwierdź</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
