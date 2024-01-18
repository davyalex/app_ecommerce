@extends('site.layouts.app')

@section('title', 'Mes commandes')



@section('content')
    <!--start to page content-->
    @auth
        <div class="page-content p-0">


            <ul class="list-group list-group-flush rounded-0">
                {{-- <li class="list-group-item py-3">
                    <form>
                        <div class="position-relative">
                            <input type="text" class="form-control ps-5 rounded-3" placeholder="Search Product...">
                            <span class="position-absolute top-50 product-show translate-middle-y"><i
                                    class="bi bi-search ms-3"></i></span>
                        </div>
                    </form>
                </li> --}}
                @if (count($orders) > 0)
                    @foreach ($orders as $item)
                        <a href="{{ route('detail-order', $item['id']) }}">
                            <li class="list-group-item py-3">
                                <div class="d-flex flex-row align-items-start align-items-stretch gap-3">
                                    {{-- @foreach ($item->products as $image) --}}
                                        <div class="product-img">
                                            <img src="{{asset('assets/images/avatars/orderIcon.png')}}"
                                            class="rounded-3" width="100" alt="">
                                        </div>
                                    {{-- @endforeach --}}


                                    <div class="product-info flex-grow-1">
                                        <h6 class="fw-bold mb-1 text-dark"><i>Commande #{{ $item['code'] }}</i> </h6>
                                        <p class="mb-0"> Commandé le {{ $item['created_at']->format('d-m-Y') }} </p>
                                        <h5>{{$item->products->count()}} article(s) commandé(s) </h5>
                                        <div class="mt-3 hstack gap-2">
                                            <button type="button" class="btn btn-sm bg-dark text-white border rounded-3">Statut
                                                :{{ $item['status'] }} </button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </a>
                    @endforeach
                @else
                    <h4 class="" style="margin-top:150px; text-align:center">Vous n'avez pas encore passé de commande</h4>
                    <div class="filter-btn bg-dark w-100 d-flex align-items-center justify-content-center">
                        <a href="{{ route('category-list') }}" class="btn btn-ecomm text-white">Ajouter un produit au panier</a>
                    </div>
                @endif

            </ul>

        </div>
    @endauth
    <!--end to page content-->

@endsection
