<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <style>
        nav svg {
            height: 20px;;

        }

        nav .hidden {
            display: block;
        }
    </style>
    <main class="main">
        {{--  --}}
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header">

                            <div class="row">
                                <div class="col-md-6">
                                    Wszystkie Kategorie

                                </div>
                                <div class="col-md-6">
                                    <a href="{{route('admin.category.add')}}" class="btn btn-success float-end">Dodaj
                                        nową kategorię</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(Session::has('message'))
                                <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                            @endif
                            @if(Session::has('error'))
                                <div class="alert alert-danger" role="alert">{{Session::get('error')}}</div>
                            @endif
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nazwa</th>
                                    <th>Slug</th>
                                    <th>Akcja</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i = ($categories->currentPage()-1)*$categories->perPage();
                                @endphp
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->slug}}</td>
                                        <td>
                                            <a href="{{route('admin.category.edit',['category_id'=>$category->id])}}"
                                               class="text-info">Edytuj</a>
                                            <a href="#" class="text-danger"
                                               onclick="deleteConfirmation({{$category->id}})"
                                               style="margin-left:20px ">Usuń</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$categories->links()}}
                        </div>
                        <div class="float-end">

                            <span class="mr-2">
                                <a href="#" class="btn btn-primary" wire:click="exportToJson()">Exportuj do JSON</a>
                            </span>
                            <span>
                                <a href="#" class="btn btn-primary" wire:click="exportToXML()">Exportuj do XML</a>
                            </span>
                        </div>
                    </div>
                    <div>
                        <br>
                    </div>
                    <div>
                        <div class="float-end">
                            <form wire:submit.prevent="storeCategory" enctype="multipart/form-data">
                                <div>
                                    <label for="jsonFile">Wybierz plik JSON:</label>
                                    <input type="file" id="jsonFile" wire:model="jsonFile">
                                    @error('jsonFile') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <button type="submit">Dodaj kategorie</button>
                                </div>
                            </form>
                        </div>

                        <div class="float-end">
                            <form wire:submit.prevent="importFromXml" enctype="multipart/form-data">
                                <div>
                                    <label for="xmlFile">Wybierz plik XML:</label>
                                    <input type="file" id="xmlFile" wire:model="xmlFile">
                                    @error('xmlFile') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <button type="submit">Dodaj kategorie</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div>
                        <br>
                    </div>

                </div>
            </div>
        </section>
    </main>
</div>

<div class="modal" id="deleteConfirmation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body pb-30 pt-30">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="pb-3">Czy napewno chcesz usunąć ten rekord?</h4>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                data-bs-target="#deleteConfirmation">Anuluj
                        </button>
                        <button type="button" class="btn btn-danger" onclick="deleteCategory()">Usuń</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteConfirmation(id) {
        @this.set('category_id', id);
            $('#deleteConfirmation').modal('show');
        }

        function deleteCategory() {
        @this.call('deleteCategory');
            $('#deleteConfirmation').modal('hide');
        }
    </script>
@endpush
