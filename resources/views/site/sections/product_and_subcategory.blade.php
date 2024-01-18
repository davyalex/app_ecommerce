<style>
    .adapted-img  {
        width:100%;
        height:200px;
        object-fit:contain;
        /* margin-bottom: -10px; */

    }

    .product-price {
        color: #212529;
        font-weight: 500;
        font-size: 13px;
        font-family: Montserrat, sans-serif;
        /* @font-face {
            font-family:"Montserrat-Bold";
            src: url("montserrat/Montserrat-Bold.ttf");
        } */
    }

    .product-card{
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }

    .section-title {
        background-color: #212529;
        color: white;
        padding: 3px;
    }
</style>
{{-- ### --}}


@foreach ($subcategory_with_product as $item)
    {{-- $product is category or section --}}
    <div class="sales-category-wrapper">
        <div class="section-cat">
            {{-- category  or section --}}
            <h6 class="my-2 text-center fw-bold section-title " style="text-transform:uppercase">{{ $item['name'] }} 
                <a href="/shop?subcategory={{$item['id']}}" class="text-white">
                    <i class="py-1" style="float:right; font-size:11px">Voir tout <i class="bi bi-chevron-right"></i> </i>

                </a>
            </h6>
            
        </div>

        {{-- start  get product in category carrousel --}}
        @if ($item['type_affichage'] == 'carrousel')
            <div class="sales-accessories-slider">
                @foreach ($item['products'] as $item)
                <div class="card rounded-3 product-card" style="width: 100%;height:100% " >
                    <div class="position-relative overflow-hidden" style="width: 100%;height:200px ">
                            <a href="{{ route('product-detail', $item['id']) }}">
                                <img src="{{ $item->getFirstMediaUrl('product_image') }}" class="img-fluid adapted-img"
                                    alt="{{ $item->getFirstMediaUrl('product_image') }}">
                            </a>

                        </div>

                        <div class="card-body mt-0" style="padding:none">
                            <div class="hstack align-items-center justify-content-between">
                                <h5 class="mb-0 product-short-title"
                                    style="font-family:Montserrat,sans-serif; color:#404040;">
                                    {{ $item['title'] ? ucFirst(Str::limit($item['title'], 17, '...')) : $item['code'] }}
                                </h5>
                                {{-- <div class="wishlist"><i class="bi bi-heart"></i></div> --}}
                            </div>
                            <p style="position:absolute; top:-4px;"
                                class="mt-1 mb-0 product-short-name font-12 fw-bold bg-dark text-white px-2">
                                {{ $item->collection ? ucFirst($item->collection['name']) : '' }} </p>
                            <div class="d-flex align-items-center gap-1 mt-2">
                                <h5 class="" style="font-weight:600">{{ number_format($item['price'], 0) }} Fcfa</h5>
                                {{-- <div class="fw-light text-muted text-decoration-line-through">$2089</div> --}}
                                {{-- <div class="fw-bold text-danger">(70% off)</div> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- End  get product in category carrousel --}}




            <!--start get product in category bloc -->
        @elseif($item['type_affichage'] == 'bloc')
            <div class="product-grid">
                <div class="row row-cols-2 row-cols-md-3 g-1">

                    @foreach ($item['products'] as $item)
                        <div class="col">
                            <div class="card rounded-3 product-card" style="width: 100%;height:100% " >
                                <div class="position-relative overflow-hidden" style="width: 100%;height:200px ">
                                    <a href="{{ route('product-detail', $item['id']) }}">
                                        <img src="{{ $item->getFirstMediaUrl('product_image') }}"
                                            class="img-fluid rounded-3 adapted-img" alt="...">
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
                                        <h5 class=""  style="font-weight:600">{{ number_format($item['price'], 0) }} Fcfa</h5>
                                        {{-- <div class="fw-light text-muted text-decoration-line-through">$2089</div> --}}
                                        {{-- <div class="fw-bold text-danger">(70% off)</div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach



                </div><!--end row-->
            </div>
        @endif
        <!--end get product in category bloc-->









    </div>
@endforeach


{{-- ### --}}
