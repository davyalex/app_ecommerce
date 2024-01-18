@extends('site.layouts.app')

@section('title', 'Commande ' . $orders->code)



@section('content')
    <!--start to page content-->
    @auth
        <div class="page-content p-0">

            @include('admin.components.validationMessage')

            <ul class="list-group list-group-flush rounded-0">

                {{-- <div class="fst-italic p-2">
                    <span class="text-dark fw-bold">Commande: #{{ $orders['code'] }} <span class="bg-dark text-white p-1">{{$orders['status']}} </span>  </span><br>
                    <span>Commandé le: {{ $orders['created_at']->format('d-m-Y') }} </span><br>
                    <span>Nbre articles: {{ $orders['quantity_product'] }} </span><br>
                    <span class="text-dark fw-bold">Total: {{ $orders['total'] }} </span><br>
                    <span>Méthode de paiement: {{ $orders['payement_method'] }} </span><br>

                </div> --}}
                <h6 class="p-2">Date de commande: {{ $orders['created_at']->format('d-m-Y') }}
                </h6>
                <h6 class="text-bg-success"> Statut: {{$orders['status']}}</h6>
                <h6 class="p-2" style="background-color: #e1e6ea">Articles commandés

                </h6>
                @foreach ($orders['products'] as $item)
                    <li class="list-group-item py-3">
                        <div class="d-flex flex-row align-items-start align-items-stretch gap-3">
                            <div class="product-img">
                                <a href="{{ route('product-detail', $item['id']) }}">
                                    <img src="{{ $item->getFirstMediaUrl('product_image') }}" class="rounded-3" width="100"
                                        alt=""></a>
                            </div>
                            <div class="product-info ">
                                {{-- <h6 class="fw-bold mb-1 text-dark">Checked Straight Kurta</h6> --}}
                                <p class="mb-0 text-black">{{ $item['title'] }} </p>
                                <div class="mt-1">
                                    <small
                                        class="fst-italic">{{ $item['pivot']['options'] && is_numeric($item['pivot']['options'][0]) ? 'Pointure: ' : ($item['pivot']['options'] && ctype_alpha($item['pivot']['options'][0]) ? 'Taille:' : '') }}
                                        {{ $item['pivot']['options'] }}</small><br>
                                    <small class="fst-italic">Qté :{{ $item['pivot']['quantity'] }} </small><br>
                                    <small class="fst-italic">Pu :{{ number_format($item['pivot']['unit_price']) }} FCFA
                                    </small>

                                    <br><p class="text-dark fw-bolder"><i class="bi bi-grid"></i> {{$item['pivot']['available']==null ? 'En attente de verification' : $item['pivot']['available'] }} </p>
                                </div>
                            </div>
                        </div>

                        {{-- start change state of available --}}
                        @if ($orders['status'] =='attente' || $orders['status'] =='annulée')
                            
                        <form class=""action="{{route('vendor-available', $orders['id'])}}" method="post">
                            @csrf
                           <div class="row form-group">
                            <div class="col-8">
                                <select class="form-control" name="state" id="" required>
                                    <option disabled value selected>Choisir une option</option>
                                    <option value="disponible">Disponible</option>
                                    <option value="pas disponible">Pas disponible</option>
                                    <option value="reserve">Reservation</option>
                                </select>
                                <input value="{{$item['id']}}" name="product_id" type="text" hidden>
                               
                            </div>
                            <div class="col-4">
                                <button class="btn btn-dark" type="submit">Valider</button>
                            </div>
                            
                            </div> 
                        </form>
                        @endif


                        {{-- end change state of available --}}

                    </li>
                @endforeach

                {{-- start delivery info --}}

                {{-- <h6 class="p-2" style="background-color: #e1e6ea">Adresse de Livraison</h6>

                <div class="fst-italic p-2">
                    <span class="text-dark">#Livraison à domicile</span><br>
                    <span class="">Lieu de livraison: {{ $orders['delivery_name'] }} </span><br>
                    <span>Tarif livraison: {{ $orders['delivery_price'] }} </span><br>
                    <span>Client: {{ $orders['user']['name'] }} </span><br>

                </div>

                <h6 class="p-2" style="background-color: #e1e6ea">Expédition</h6>

                <div class="fst-italic p-2">
                    <span class="">Livraison prevue le :  {{ \Carbon\Carbon::parse($orders['delivery_planned'])->isoFormat('dddd D MMMM YYYY') }} </span><br>
                    <span class="">Date de livraison : {{ $orders['delivery_date']!==null ? \Carbon\Carbon::parse($orders['delivery_date'])->isoFormat('dddd D MMMM YYYY') : 'En attende livraison'  }} </span><br>

                </div> --}}

                {{-- start delivery info --}}

        </div>
        <!--end to page content-->

    @endauth
    <!--end to page content-->

@endsection
