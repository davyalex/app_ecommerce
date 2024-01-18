  <!--start brands slider-->
  <div class="sales-category-wrapper">
      <h4 class="my-1 text-center fw-bold ">Nos collections</h4>
      <div class="brands-slider">
        @foreach ($collection as $item)
        <div class="">
            <div class="  border-0">
                <a href="/shop?collection={{$item['id']}}">
                    <h5 class="text-center text-capitalize text-white bg-dark rounded-2 py-2">{{$item['name']}} </h5>
                    {{-- <img src="{{ $item->getFirstMediaUrl('collection_image') }}" class="img-fluid" alt="{{$item['name']}}"> --}}
                </a>
            </div>
        </div>
        @endforeach
      </div>
  </div>
  <!--end brands slider-->


  {{-- <div class="sales-category-wrapper">
      <h4 class="my-2 text-center fw-bold section-title">Accessories</h4>
      <div class="sales-accessories-slider">
          <div class="card rounded-3 overflow-hidden">
              <a href="shop.html"><img src="assets/images/accessories/01.webp" class="img-fluid" alt=""></a>
              <div class="card-body text-center">
                  <p class="mb-0 fw-bold">Women Caps</p>
              </div>
          </div>
          <div class="card rounded-3 overflow-hidden">
              <a href="shop.html"><img src="assets/images/accessories/02.webp" class="img-fluid" alt=""></a>
              <div class="card-body text-center">
                  <p class="mb-0 fw-bold">Men Belts</p>
              </div>
          </div>
          <div class="card rounded-3 overflow-hidden">
              <a href="shop.html"><img src="assets/images/accessories/03.webp" class="img-fluid" alt=""></a>
              <div class="card-body text-center">
                  <p class="mb-0 fw-bold">Ladies Purse</p>
              </div>
          </div>
          <div class="card rounded-3 overflow-hidden">
              <a href="shop.html"><img src="assets/images/accessories/04.webp" class="img-fluid" alt=""></a>
              <div class="card-body text-center">
                  <p class="mb-0 fw-bold">Headphones</p>
              </div>
          </div>

      </div>
  </div> --}}
