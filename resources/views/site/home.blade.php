@extends('site.layouts.app')

@section('title', 'Home')
@section('url', url()->current())

@section('content')
    <!--start to page content-->
    <div class="page-content">

        <!--start banner slider-->
        @include('site.sections.slider')
        <!--end banner slider-->


        <div class="p-0"></div>
        <!--start collection-->
        {{-- @include('site.sections.collection') --}}
        <!--end collection-->


        {{-- <div class="py-1"></div> --}}




        <!--start subcategory-->
        {{-- @include('site.sections.subcategory') --}}
        <!--end subcategory-->

        <!--start category-->
        @include('site.sections.category')
        <!--end category-->

        <div class="pb-2"></div>

        <!--start category and product-->
        @include('site.sections.product_and_category')
        <!--end category and product-->

        <div class=""></div>

        <!--start subcategory and product-->
        @include('site.sections.product_and_subcategory')
        <!--end subcategory and product-->

        <div class="py-2"></div>

        <!--start collection-->
        @include('site.sections.collection')
        <!--end collection-->


        <!--start features-->
        {{-- <div class="features-section">
            <div class="row row-cols-4 row-cols-md-12 g-1">
                <div class="col d-flex">
                    <div class="card rounded-3 w-100">
                        <div class="card-body">
                            <div class="icon-wrapper text-center">
                                <div class="noti-box mb-1 mx-auto bg-primary">
                                    <i class="bi bi-truck"></i>
                                </div>
                                <p class="fw-bold mb-0 text-dark">Free Delivery</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col d-flex">
                    <div class="card rounded-3 w-100">
                        <div class="card-body">
                            <div class="icon-wrapper text-center">
                                <div class="noti-box mb-1 mx-auto bg-purple">
                                    <i class="bi bi-credit-card"></i>
                                </div>
                                <p class="fw-bold mb-0 text-dark">Secure Payment</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col d-flex">
                    <div class="card rounded-3 w-100">
                        <div class="card-body">
                            <div class="icon-wrapper text-center">
                                <div class="noti-box mb-1 mx-auto bg-red">
                                    <i class="bi bi-minecart-loaded"></i>
                                </div>
                                <p class="fw-bold mb-0 text-dark">Free Returns</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col d-flex">
                    <div class="card rounded-3 w-100">
                        <div class="card-body">
                            <div class="icon-wrapper text-center">
                                <div class="noti-box mb-1 mx-auto bg-green">
                                    <i class="bi bi-headset"></i>
                                </div>
                                <p class="fw-bold mb-0 text-dark">24/7 Support</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!--end features-->
    </div>
    <!--end to page content-->
@endsection
