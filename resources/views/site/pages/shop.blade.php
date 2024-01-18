@extends('site.layouts.app')

@section('title', request('search') ? request('search') : $title_name)
@section('url', url()->current())

@section('content')

    <style>
        .adapted-img {
            width: 100%;
            height: 200px;
            object-fit: contain;
            /* margin-bottom: -10px; */

        }

        .product-card{
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }

        /* .adapted-img-banner img {
                    width: 100%;
                    height: 100px;
                    object-fit: cover;

                } */

        /* .img-div{
                   max-width: 700px;
                   max-height: 700px;
                   border : 1px solid rgb(226, 212, 212)

                } */
        /* .adapted-img-product img {
                    width:500px;
                    height: 200px;
                    object-fit: contain;

                } */
    </style>
    <!--start to page content-->
    <div class="page-content p-0">
        <div class="page-banner mb-1 adapted-img-banner">
            <img src="{{ request('category')
                ? $category->getFirstMediaUrl('category_banner')
                : (request('subcategory')
                    ? $title->category->getFirstMediaUrl('category_banner')
                    : asset('assets/images/site_images/category_banner_default.jpg')) }}"
                class="img-fluid rounded-0" alt="...">
        </div>

        <!--start produt grid-->
        <div class="product-grid">
            <div class="row row-cols-2 row-cols-md-3 g-1">
                @if ($product->count() > 0)
                    @foreach ($product as $item)
                        <div class="col img-div">
                            <div class="card rounded-3 product-card" style="width: 100%;height:100% ">
                                <div class="position-relative overflow-hidden  adapted-img-product">
                                    <a href="{{ route('product-detail', $item['id']) }}">
                                        <img src="{{ $item->getFirstMediaUrl('product_image') }}"
                                            class="img-fluid  rounded-top-3 adapted-img" alt="...">
                                    </a>
                                </div>
                                <div class="card-body" style="padding:none">
                                    <div class="hstack align-items-center justify-content-between">
                                        <h5 class="mb-0 product-short-title"
                                            style="font-family:Montserrat,sans-serif; color:#404040">
                                            {{ $item['title'] ? ucFirst(Str::limit($item['title'], 17, '...')) : $item['code'] }}
                                        </h5>
                                        {{-- <div class="wishlist"><i class="bi bi-heart"></i></div> --}}
                                    </div>
                                    <p style="position:absolute; top:-4px;"
                                        class="mt-1 mb-0 product-short-name font-12 fw-bold text-bg-dark text-white px-2">
                                        {{ $item->collection ? ucFirst($item->collection['name']) : '' }} </p>
                                    <div class="d-flex align-items-center gap-1 mt-2">
                                        <h5 class="product-price">{{ number_format($item['price'], 0) }} Fcfa</h5>
                                        {{-- <div class="fw-light text-muted text-decoration-line-through">$2089</div> --}}
                                        {{-- <div class="fw-bold text-danger">(70% off)</div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h2 class="text-center mt-5 w-100">Pas de produit disponible
                        <br><small class="m-auto text-secondary fs-6">Pour la categorie ou votre recherche</small>
                    </h2>
                @endif


            </div><!--end row-->

            <div class="py-2 m-auto">
                @if ($product->count() > 0)
                    
                {!! $product->appends(request()->query())->links('pagination::bootstrap-4') !!}
                @endif
    
            </div>
        </div>
        <!--end produt grid-->
        
        <div class="py-2"></div>
        <!--start collection-->
        @include('site.sections.collection')
    </div>
    <!--end to page content-->
@endsection
