@extends('site.layouts.app')

@section('title', 'Categorie')
@section('url',url()->current())


@section('content')

<style>
     /* .adapted-image-cat img {
        width:auto;
        height:100px;
        object-fit: contain;
        text-align: center;
    } */
</style>

    <!--start to page content-->
    <div class="page-content">

        <div class="row row-cols-2 g-3">
            @foreach ($category as $item)
            <div class="col">
                @if (count($item['subcategories'])> 0)
                <a href="/subcategory?c={{$item['id']}}">
                @else
                <a href="/shop?category={{$item['id']}}">

                @endif
                    <div class="card rounded-3 mb-0">
                        <div class="card-body">
                            <div
                                class="d-flex flex-column flex-column-reverse align-items-center justify-content-between gap-2">
                                <div class="category-name">
                                    <h6 class="mb-0 fw-bold text-dark" style="font-size: 14px ; text-transform:uppercase">{{$item['name']}}</h6>
                                    <small class="text-center text-secondary"> {{$item->products->count()}} produit(s) </small>
                                </div>
                                <div class="category-img adapted-image-cat">
                                    <img src="{{$item->getFirstMediaUrl('category_image')}}" class="img-fluid"
                                        width="100" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach

        </div><!--end row-->
        <div class="pt-2"></div>
        <!--start collection-->
        @include('site.sections.collection')
    </div>
    
    <!--end to page content-->
@endsection
