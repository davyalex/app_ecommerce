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

        @foreach ($subcategory as $item)
            <div class="category-img col-4">
                <figure class="text-center">
                    <a href="/shop?subcategory={{$item['id']}}">
     
        <img src="{{ $item->getFirstMediaUrl('subcategory_image') }}" class="img-fluid rounded  adapted-image"
            alt="{{ $item->getFirstMediaUrl('subcategory_image') }}">
        </a>
        {{-- <figcaption>{{ $item['name'] }}</figcaption> --}}
        </figure>
    </div>
    @endforeach
</div>
</div>
