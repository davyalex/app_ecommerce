<style>
   /* .adapted-image {
        width:auto;
        height:70px;
        object-fit: contain;
        text-align: center;
    } */
</style>

<div class="category">
    <div class=" row align-items-center ">

@foreach ($category as $item)

{{-- @if ($item['type']=='section' && $item->products->count() > 0) --}}
<div class="category-img col-4">
    <figure class="text-center">
        @if (count($item['subcategories'])> 0)
        <a href="/subcategory?c={{$item['id']}}">
        @else
        <a href="/shop?category={{$item['id']}}">

        @endif
            <img src="{{$item->getFirstMediaUrl('category_image')}}" class="img-fluid rounded  adapted-image" alt="{{$item->getFirstMediaUrl('category_image')}}">
        </a>
        {{-- <figcaption>{{$item['name']}}</figcaption> --}}
    </figure>
</div>
{{-- @endif --}}
  @endforeach
    </div>
</div>

