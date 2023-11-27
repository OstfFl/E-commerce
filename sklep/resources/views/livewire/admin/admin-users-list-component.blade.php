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

        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header">

                            <div class="row">
                                <div class="col-md-6">
                                    Wszystkie Użytkownicy
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            @if(Session::has('message'))
                                <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                            @endif
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>id</th>
                                    <th>Nazwa</th>
                                    <th>Email</th>
                                    <th>typ Użytkownika</th>
                                    <th>Data</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i = ($users->currentPage()-1)*$users->perPage();
                                @endphp
                                @foreach($users as $user)
                                    <tr>

                                        <td>{{++$i}}</td>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->utype}}</td>
                                        <td>{{$user->created_at}}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{--                            {{$products->links()}}--}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

