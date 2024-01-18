@extends('site.layouts.app')

@section('title', 'Mon compte')

@section('content')
    @auth
        <!--start to page content-->
        <div class="page-content">
            @php
                $array = [
                    "name" => Auth::user()->name,
                    "email" => Auth::user()->email,
                    "phone" => Auth::user()->phone,
        ];
            
                $msg_incomplete = $array['name'] !=null && $array['email'] !=null  && $array['phone'] !=null ? '' : 'Veuillez completer vos infos'
            @endphp

            @include('admin.components.validationMessage')
            <div class="profile-img mb-3 border p-3 text-center rounded-3 bg-light">
                <img src="{{Auth::user()->avatar ? Auth::user()->avatar  : asset('assets/images/avatars/avatar.png')}}" width="90" height="90" class="rounded-circle" alt="">
                <h6 class="mb-0 fw-bold mt-3">Bienvenue, <i> {{ucFirst(Auth::user()->name)}}</i> </h6>
            </div>

            <div class="mb-3">
                <a class="profile-item" href="{{route('my-profile',Auth::user()->id )}}">
                    <div class="card rounded-3">
                        <div class="card-body py-2">
                            <div class="d-flex align-items-center gap-3 fs-6">
                                <div><i class="bi bi-person"></i></div>
                                <div class="flex-grow-1">Mon profil <small class="text-danger"> <i>{{$msg_incomplete}}</i> </small> </div>
                                <div><i class="bi bi-chevron-right"></i></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="mb-3">
                <a class="profile-item" href="{{route('my-order')}}">
                    <div class="card rounded-3">
                        <div class="card-body py-2">
                            <div class="d-flex align-items-center gap-3 fs-6">
                                <div><i class="bi bi-basket3"></i></div>
                                <div class="flex-grow-1">Mes commandes (<span class="text-dark fw-bold">  {{Auth::user()->orders ->count()}}</span> )</div>
                                <div><i class="bi bi-chevron-right"></i></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="mb-3">
                <a class="profile-item" href="">
                    <div class="card rounded-3">
                        <div class="card-body py-2">
                            <div class="d-flex align-items-center gap-3 fs-6">
                                <div><i class="bi bi-bell"></i></div>
                                <div class="flex-grow-1">Mes Notifications</div>
                                <div><i class="bi bi-chevron-right"></i></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        
            @if (Auth::user() && Auth::user()->role !='client')
            <hr class="my-5">


            {{-- start vendor espace --}}
           
            <h3 class="text-center">Mon espece vendeur</h3>
           @include('site.sections.dashboard_vendor')
            @endif

             {{-- end vendor espace --}}

            {{-- <div class="mb-3">
                <a class="profile-item" href="wishlist.html">
                    <div class="card rounded-3">
                        <div class="card-body py-2">
                            <div class="d-flex align-items-center gap-3 fs-6">
                                <div><i class="bi bi-heart"></i></div>
                                <div class="flex-grow-1">Ma Liste d'envies</div>
                                <div><i class="bi bi-chevron-right"></i></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div> --}}

            <div class="mb-3">
                <a class="profile-item" href="{{route('logout')}}">
                    <div class="card rounded-3">
                        <div class="card-body py-2">
                            <div class="d-flex align-items-center gap-3 fs-6">
                                <div><i class="bi bi-box-arrow-right"></i></div>
                                <div class="flex-grow-1">Déconnexion</div>
                                <div><i class="bi bi-chevron-right"></i></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
        <!--end to page content-->
    @endauth
@endsection
