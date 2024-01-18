{{-- <style>
  #adapted-image {
       width:auto;
       /* height:70px; */
       object-fit: contain;
   }
</style> --}}

<div class="banner-slider">
  @foreach ($slider_banniere as $item)
      
  <div class="banner-item">
    <a href="{{route('shop')}}"><img src="{{$item->getFirstMediaUrl('slider_image')}}" class="img-fluid rounded-3" id="adapted-image" alt=""></a>
  </div>
  @endforeach
    {{-- <div class="banner-item">
      <a href="shop.html"><img src="../assets/images/banner-sliders/02.webp" class="img-fluid rounded-3" alt=""></a>
    </div>
    <div class="banner-item">
      <a href="shop.html"><img src="../assets/images/banner-sliders/03.webp" class="img-fluid rounded-3" alt=""></a>
    </div>
    <div class="banner-item">
      <a href="shop.html"><img src="../assets/images/banner-sliders/04.webp" class="img-fluid rounded-3" alt=""></a>
    </div>
    <div class="banner-item">
      <a href="shop.html"><img src="../assets/images/banner-sliders/05.webp" class="img-fluid rounded-3" alt=""></a>
    </div>
    <div class="banner-item">
      <a href="shop.html"><img src="../assets/images/banner-sliders/06.webp" class="img-fluid rounded-3" alt=""></a>
    </div> --}}
  </div>