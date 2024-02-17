@extends('admin.layouts.app')



@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('admin/assets/bundles/jquery-selectric/selectric.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('admin/assets/bundles/select2/dist/css/select2.min.css') }}">
@endsection

<style>
    img {
        max-width: 180px;
    }

    input[type=file] {
        padding: 10px;
        background: #eaeaea;
    }
</style>


@section('content')
    <section class="section">
        <div class="container mt-1">
            <div class="row">
                <a class="btn btn-primary fas fa-arrow-left mb-2" href="{{ route('user.list') }}"> Retour à la liste des
                    utilisateurs</a>
                <div
                    class="col-12 col-sm-10 offset-sm-1 col-md-10 offset-md-2 col-lg-10 offset-lg-2 col-xl-10 offset-xl-2 m-auto">
                    @if (session('user_auth'))
                        @php
                            $getData = Session::get('user_auth');
                        @endphp

                        <div class="alert alert-primary">
                            <h5>Les informations de connexions du dernier utilisateur</h5>
                            Email: {{ $getData['email'] }}
                            <br> Mot de passe : {{ $getData['pwd'] }}

                        </div>
                    @endif

                    <div class="card card-primary">
                        @include('admin.components.validationMessage')
                        <div>

                        </div>
                        <div class="card-header">
                            <h4>Nouvel utilisateur</h4>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" novalidate="" method="POST"
                                action="{{ route('user.register') }}">
                                @csrf

                                <!-- ========== Start role ========== -->
                                <div class="form-group col-12">
                                    <label for="password2" class="d-block">Type utilisateur</label>
                                    <select name="role" class="form-control select2" id="role" required>
                                        <option disabled selected value>Choisir un role</option>
                                        @if (Auth::user()->hasRole('developpeur'))
                                            @foreach ($roles_for_developpeur as $item)
                                                <option value="{{ $item['name'] }}"> {{ $item['name'] }} </option>
                                            @endforeach
                                        @else
                                            @foreach ($roles as $item)
                                                <option value="{{ $item['name'] }}"> {{ $item['name'] }} </option>
                                            @endforeach
                                        @endif

                                    </select>
                                    <div class="invalid-feedback">
                                        Champs obligatoire
                                    </div>
                                </div>
                                <!-- ========== End role ========== -->


                                <div class="row shop">
                                    <div class="form-group col-6">
                                        <label for="shopName">Nom de boutique</label>
                                        <input type="text" class="form-control" id="shopName"
                                            name="shop_name" required>
                                        <div class="invalid-feedback">
                                            Champs obligatoire
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="shopName">Localisation (boutique) <small class="text-danger">Ex:
                                                Abidjan, cocody angre</small> </label>
                                        <input id="shopName" type="text" class="form-control"
                                            name="localisation" required>
                                        <div class="invalid-feedback">
                                            Champs obligatoire
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-12 fullName">
                                    <label for="frist_name">Nom & prenoms</label>
                                    <input id="fullName" type="text" class="form-control" name="name" autofocus
                                        required>
                                    <div class="invalid-feedback">
                                        Champs obligatoire
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6 phone">
                                        <label for="last_name">Telephone</label>
                                        <input  type="number" id="phone" class="form-control"
                                            name="phone" required>
                                        <div class="invalid-feedback">
                                            Champs obligatoire
                                        </div>
                                    </div>

                                    <div class="form-group col-6 email">
                                        <label for="email">Email</label>
                                        <input  type="email" class="form-control" id="email"
                                            name="email" required>
                                        <div class="invalid-feedback">
                                            Champs obligatoire
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group col-12 logo">
                                    <label for="logo_boutique">Logo de la boutique</label>
                                    <img id="img-preview"
                                        src="https://ami-sni.com/wp-content/themes/consultix/images/no-image-found-360x250.png"
                                        width="250px" />
                                    <input type="file" name="logo" class="form-control" id="logo"
                                        onchange="readURL(this);">
                                </div>



                                <div class="form-group">
                                    <button type="submit" id="btnRegister" class="btn btn-primary btn-lg btn-block w-100">
                                        Enregistrer
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        //logo preview img
        function readURL(input) {
            let noimage =
                "https://ami-sni.com/wp-content/themes/consultix/images/no-image-found-360x250.png";
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#img-preview')
                        .attr('src', e.target.result);
                };


                reader.readAsDataURL(input.files[0]);
            } else {
                $("#img-preview").attr("src", noimage);
            }
        }

        $(document).ready(function() {
            //afficher en fonction du role

            $('.fullName').hide(200);
            $('.shop').hide(200);
            $('.logo').hide(200);
            $('.phone').hide(200);
            $('.email').hide(200);
            $('#btnRegister').hide(200);




            $('#role').change(function(e) {
            $('#btnRegister').show(200);
                var roleSelected = $("#role option:selected").val();
                if (roleSelected === 'administrateur' || roleSelected === 'client') {
                    $('.shop').hide(200);
                    $('.logo').hide(200);
                    $('.fullName').show(200);
                    $('.phone').show(200);
                    $('.email').show(200);
                    $('#shopName').prop("required", false);
                    $('#localisation').prop("required", false);
                } else if (roleSelected === 'boutique') {
                    $('.fullName').hide(200);
                    $('.shop').show(200);
                    $('.logo').show(200);
                     $('.phone').show(200);
                    $('.email').show(200);
                    $('#shopName').prop("required", true);
                    $('#localisation').prop("required", true);
                    $('#fullName').prop("required", false);
                }


            });
        });
    </script>


@endsection

@section('script')
    <script src="{{ asset('admin/assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
    {{-- <script src="{{ asset('admin/assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script> --}}
@endsection
