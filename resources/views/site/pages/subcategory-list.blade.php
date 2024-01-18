@extends('site.layouts.app')

@section('title', $title['name'])
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
            @foreach ($subcategory as $item)
            <div class="col">
                <a href="/shop?subcategory={{$item['id']}}">
                    <div class="card rounded-3 mb-0">
                        <div class="card-body">
                            <div
                                class="d-flex flex-column flex-column-reverse align-items-center justify-content-between gap-2">
                                <div class="category-name">
                                    <h6 class="mb-0 fw-bold text-dark" style="font-size: 14px; text-transform:capitalize">{{$item['name']}}</h6>
                                    <small class="text-center text-secondary"> {{$item->products->count()}} produit(s) </small>
                                </div>
                                <div class="category-img adapted-image-cat">
                                    <img src="{{$item->getFirstMediaUrl('subcategory_image')}}" class="img-fluid"
                                        width="100" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
          
        </div><!--end row-->

    </div>
    <!--end to page content-->
@endsection
