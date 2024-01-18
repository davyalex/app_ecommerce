@extends('site.layouts.app')

@section('title', 'Aide-Support')

@section('content')
    @auth
        <!--start to page content-->
        <div class="page-content">
    

           

            <div class="mb-3">
                <a class="nav-link text-dark" href="{{route('help-becomeVendor')}}">
                    <div class="card rounded-3">
                        <div class="card-body py-2">
                            <div class="d-flex align-items-center gap-3 fs-6">
                                <div><i class="bi bi-cart"></i></div>
                                <div class="flex-grow-1">Comment devenir vendeur</div>
                                <div><i class="bi bi-chevron-right"></i></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="mb-3">
                <a class="nav-link text-dark" href="{{route('help-assistance')}}">
                    <div class="card rounded-3">
                        <div class="card-body py-2">
                            <div class="d-flex align-items-center gap-3 fs-6">
                                <div><i class="bi bi-phone-flip"></i></div>
                                <div class="flex-grow-1">Assistance</div>
                                <div><i class="bi bi-chevron-right"></i></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="mb-3">
                <a class="nav-link text-dark" href="{{route('help-about')}}">
                    <div class="card rounded-3">
                        <div class="card-body py-2">
                            <div class="d-flex align-items-center gap-3 fs-6">
                                <div><i class="bi bi-person"></i></div>
                                <div class="flex-grow-1">A propos de nous</div>
                                <div><i class="bi bi-chevron-right"></i></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="mb-3">
                <a class="nav-link text-dark" href="{{route('help-privacyPolicy')}}">
                    <div class="card rounded-3">
                        <div class="card-body py-2">
                            <div class="d-flex align-items-center gap-3 fs-6">
                                <div><i class="bi bi-filetype-key"></i></div>
                                <div class="flex-grow-1">Politique de confidentialité</div>
                                <div><i class="bi bi-chevron-right"></i></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>



        
         
          

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
