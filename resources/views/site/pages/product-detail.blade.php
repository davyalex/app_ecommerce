@extends('site.layouts.app')

@section('title', $product['title'])
@section('description',$product->description)
@section('image',asset($product->getFirstMediaUrl('product_image')))
@section('url',url()->current())

@section('content')

    <style>
        .adapted-img img {
            width: 100%;
            height: auto;
            object-fit: contain;

        }

        /* //button select */


        label {
            padding: 10px 16px;
            line-height: 190%;
            outline-style: none;
            transition: all .6s;
            width: 50px;
            height: 50px;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            border: 1px solid #212529;
            /* border-radius: 50%; */
            color: #222121;
            font-weight: 600;
            margin: 2px;
            text-transform: uppercase;
            background-color: #ffffff;
            transition: 0.3s cubic-bezier(0.075, 0.82, 0.165, 1);
        }

        .hiddenCB label:hover,
        .hiddenCB label:focus {
            color: #212529;
            border: 1px solid #212529;
            background-color: rgb(242, 236, 236);
        }

        .hiddenCB div {
            display: block;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .hiddenCB input[type="checkbox"],
        .hiddenCB input[type="radio"] {
            display: none;

        }

        .hiddenCB label {

            cursor: pointer;
        }

        .hiddenCB input[type="checkbox"]+label:hover {
            background: rgb(255, 255, 255)255);

        }

        .hiddenCB input[type="checkbox"]:checked+label {
            background: #212529;
            color: white;
        }

        .hiddenCB input[type="checkbox"]:checked+label:hover {
            background: #212529;
        }
    </style>


    <!--start to page content-->
    <div class="page-content p-0">
        @include('admin.components.validationMessage')

        <!--start product image slider-->
        <div class="product-slider-wrapper position-relative mb-0">
            <div class="product-image-slider mb-0">
                @foreach ($product->getMedia('product_image') as $item)
                    <div class="banner-item adapted-img">
                        <a href="javascript:;"><img src="{{ $item->getUrl() }}" class="img-fluid rounded-0"
                                alt=""></a>
                    </div>
                @endforeach
            </div>
        </div>
        <!--start product image slider-->


        <!--start product info-->
        <div class="product-info p-3">
            <h5 class="product-title fw-bold mb-1 text-center"> {{ $product['title'] }} </h5>
            {{-- <p class="mb-0">Women Pink & Off-White Printed Kurta with Palazzos</p> --}}
            <div class="product-price  gap-2 mt-2">
                <div class="h2 fw-bold bg-black text-white w-50 text-center m-auto p-1" >
                    {{ number_format($product['price']) }} Fcfa </div>
                {{-- <div class="h5 fw-light text-muted text-decoration-line-through">$2089</div>
                <div class="h5 fw-bold text-danger">(70% off)</div> --}}
            </div>
            <hr>
            <p class=" mb-0 mt-0 text-dark fst-italic">
                {{ $product->tailles->count() > 0 || $product->pointures->count() > 0 ? 'Options disponibles' : '' }}</p>
            @if ($product->tailles->count() > 0)
                <div class="size-chart mt-4">
                    <h6 class="fw-bold mb-2 text-dark">Selectionner une Taille</h6>
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <div class="hiddenCB">
                            <div>
                                @foreach ($product->tailles as $item)
                                    <input type="checkbox" class="optionChecked" name="taille" value="{{$item['taille']}}"  id="{{ $item['id'] }}"><label
                                        for="{{ $item['id'] }}">{{ $item['taille'] }}</label> </input>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            @endif

            @if ($product->pointures->count() > 0)
                <div class="size-chart mt-4">
                    <h6 class="fw-bold mb-2 text-dark">Selectionner une pointure</h6>
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <div class="hiddenCB">
                            <div>
                                @foreach ($product->pointures as $item)
                                    <input type="checkbox" class="optionChecked" name="pointure" value="{{$item['pointure']}}"  id="{{ $item['id'] }}"><label
                                        for="{{ $item['id'] }}">{{ $item['pointure'] }}</label> </input>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif


            <hr class="my-3">
            <div class="product-info">
                <h6 class="fw-bold mb-2 text-dark">{{$product['description'] ? 'Description' : ''}} </h6>

                <p class="mb-1">{!! $product['description'] !!} </p>
            </div>

            {{-- detail of vendor  if user has role == administrateur--}}
            @role('administrateur')
            <hr class="my-3">
            <div class="customer-reviews">
                <h6 class="fw-bold mb-2 text-dark">Detail du vendeur</h6>
                <div class="reviews-wrapper">
                    <div class="d-flex flex-column flex-lg-row gap-3">
                        <div class="flex-grow-1">
                            <p class="mb-2"> <i class="bi bi-person"></i> : <b>{{$product['user'] ? $product['user']['name'] : '' }} </b> </p>
                            <p class="mb-2"> <i class="bi bi-envelope"></i> : <b>{{$product['user'] ? $product['user']['email'] : ''}} </b> </p>
                            <p class="mb-2"> <i class="bi bi-phone"></i> : <b>{{$product['user']? $product['user']['phone'] : ''}} </b> </p>
                            
                            <hr class="my-2">
                            <p class="mb-2"> <i class="bi bi-geo-alt"></i> : <b>{{$product['user'] ? $product['user']['localisation'] : ''}} </b> </p>
                            <p class="mb-2"> <i class="bi bi-shop"></i> : <b>{{$product['user'] ? $product['user']['shop_name'] : ''}} </b> </p>
                        

                        </div>
                    </div>
                    <hr>
                    <div class="d-grid">
                        <a href="#" class="btn btn-ecomm rounded-3 border">Voir tous les produits de la boutique<i
                                class="bi bi-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
            @endrole


            {{-- reviews --}}
            {{-- <hr class="my-3">
            <div class="customer-ratings">
                <h6 class="fw-bold mb-2 text-dark">Customer Ratings</h6>
                <div class="d-flex align-items-center gap-4 gap-lg-5 flex-wrap flex-lg-nowrap">
                    <div class="">
                        <h1 class="mb-2 fw-bold text-dark">4.8<span class="fs-5 ms-2 text-warning"><i
                                    class="bi bi-star-fill"></i></span></h1>
                        <p class="mb-0">3.8k Verified Buyers</p>
                    </div>
                    <div class="w-100">
                        <div class="rating-wrrap hstack gap-2 align-items-center">
                            <p class="mb-0">5</p>
                            <div class=""><i class="bi bi-star"></i></div>
                            <div class="progress flex-grow-1 mb-0 rounded-3" style="height: 5px;">
                                <div class="progress-bar bg-green" role="progressbar" style="width: 75%"></div>
                            </div>
                            <p class="mb-0">1528</p>
                        </div>
                        <div class="rating-wrrap hstack gap-2 align-items-center">
                            <p class="mb-0">4</p>
                            <div class=""><i class="bi bi-star"></i></div>
                            <div class="progress flex-grow-1 mb-0 rounded-3" style="height: 5px;">
                                <div class="progress-bar bg-green" role="progressbar" style="width: 65%"></div>
                            </div>
                            <p class="mb-0">253</p>
                        </div>
                        <div class="rating-wrrap hstack gap-2 align-items-center">
                            <p class="mb-0">3</p>
                            <div class=""><i class="bi bi-star"></i></div>
                            <div class="progress flex-grow-1 mb-0 rounded-3" style="height: 5px;">
                                <div class="progress-bar bg-purple" role="progressbar" style="width: 45%"></div>
                            </div>
                            <p class="mb-0">258</p>
                        </div>
                        <div class="rating-wrrap hstack gap-2 align-items-center">
                            <p class="mb-0">2</p>
                            <div class=""><i class="bi bi-star"></i></div>
                            <div class="progress flex-grow-1 mb-0 rounded-3" style="height: 5px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 35%"></div>
                            </div>
                            <p class="mb-0">78</p>
                        </div>
                        <div class="rating-wrrap hstack gap-2 align-items-center">
                            <p class="mb-0">1</p>
                            <div class=""><i class="bi bi-star"></i></div>
                            <div class="progress flex-grow-1 mb-0 rounded-3" style="height: 5px;">
                                <div class="progress-bar bg-red" role="progressbar" style="width: 25%"></div>
                            </div>
                            <p class="mb-0">27</p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-3">
            <div class="customer-reviews">
                <h6 class="fw-bold mb-2 text-dark">Customer Reviews (875)</h6>
                <div class="reviews-wrapper">
                    <div class="d-flex flex-column flex-lg-row gap-3">
                        <div class=""><span class="badge bg-green rounded-0">5<i
                                    class="bi bi-star-fill ms-1"></i></span></div>
                        <div class="flex-grow-1">
                            <p class="mb-2">This is some content from a media component. You can replace this with any
                                content and adjust it as needed. Some quick example text to build on the card title and
                                make.</p>
                            <div class="review-img">
                                <img src="https://via.placeholder.com/540X600" class="rounded-3" alt=""
                                    width="70">
                            </div>
                            <div class="d-flex flex-column flex-sm-row gap-3 mt-3">
                                <div class="hstack flex-grow-1 gap-3">
                                    <p class="mb-0">Jhon Deo</p>
                                    <div class="vr"></div>
                                    <div class="date-posted">12 June 2020</div>
                                </div>
                                <div class="hstack">
                                    <div class=""><i class="bi bi-hand-thumbs-up me-2"></i>68</div>
                                    <div class="mx-3"></div>
                                    <div class=""><i class="bi bi-hand-thumbs-down me-2"></i>24</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                  
                  
                    <div class="d-grid">
                        <a href="reviews-and-ratings.html" class="btn btn-ecomm rounded-3 border">View All Reviws<i
                                class="bi bi-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div> --}}
        </div>
        <!--end product info-->




        <!--start similar products-->

        {{-- <div class="product-grid mt-2">
            <h4 class="mb-3 h4 fw-bold section-title text-center">Similar Products</h4>
            <div class="row row-cols-2 row-cols-md-3 g-0">
                <div class="col">
                    <div class="card rounded-0 border-0">
                        <div class="position-relative">
                            <a href="javascript:;">
                                <img src="https://via.placeholder.com/540X600" class="img-fluid rounded-0"
                                    alt="...">
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="hstack align-items-center justify-content-between">
                                <h5 class="mb-0 fw-bold product-short-title">Formal Shirt</h5>
                                <div class="wishlist"><i class="bi bi-heart"></i></div>
                            </div>
                            <p class="mt-1 mb-0 product-short-name font-12 fw-bold">Color Printed Kurta</p>
                            <div class="product-price d-flex align-items-center gap-1 mt-2 font-12">
                                <div class="fw-bold text-dark">$458</div>
                                <div class="fw-light text-muted text-decoration-line-through">$2089</div>
                                <div class="fw-bold text-danger">(70% off)</div>
                            </div>
                        </div>
                    </div>
                </div>
              

            </div><!--end row-->
        </div> --}}
        <!--start similar products-->
        <!--start to footer-->
        <footer class="page-footer border-top d-flex align-items-center justify-content-between">
            <div class="buttons  mb-5 d-flex flex-row gap-3 w-100">
                <a 
                target="_blank" href="https://wa.me/+2250142855584/?text= bonjour , je suis interressé par l'article {{ url()->current() }}
                " 
                class="btn btn-green bg-green text-white btn-ecomm rounded-3"><i class="bi bi-whatsapp me-2"></i>commander par whatsapp</a>
                <a href="{{ route('add.to.cart', $product['id']) }}" data-id="{{ $product['id'] }}"
                    class="btn btn-dark btn-ecomm flex-grow-1 rounded-3 addCart"><i
                        class="bi bi-basket2 me-2"></i>Ajouter au panier</a>
            </div>
        </footer>
        <!--end to footer-->

    </div>
    <!--end to page content-->
    @include('admin.components.scriptAddCart')

@endsection
