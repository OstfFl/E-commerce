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
                                <div class="col-md-6">
                                    Wszystkie Użytkownicy
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            @if(Session::has('message'))
                                <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                            @endif
                            @if(Session::has('error'))
                                    <div class="alert alert-alert" role="alert">{{Session::get('error')}}</div>
                                @endif
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>id</th>
                                    <th>Imie</th>
                                    <th>Nazwisko</th>
                                    <th>Adres</th>
                                    <th>Miasto</th>
                                    <th>Kraj</th>
                                    <th>Kod Pocztowy</th>
                                    <th>Numer Telefonu</th>
                                    <th>Email</th>
                                    <th>Id Produktów</th>
                                    <th>Data</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i = ($orders->currentPage()-1)*$orders->perPage();
                                @endphp
                                @foreach($orders as $order)
                                    <tr>

                                        <td>{{++$i}}</td>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->firstName}}</td>
                                        <td>{{$order->lastName}}</td>
                                        <td>{{$order->adres}}</td>
                                        <td>{{$order->city}}</td>
                                        <td>{{$order->country}}</td>
                                        <td>{{$order->postCode}}</td>
                                        <td>{{$order->phone}}</td>
                                        <td>{{$order->email}}</td>
                                        <td>{{$order->productIds}}</td>
                                        <td>{{$order->created_at}}</td>

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

