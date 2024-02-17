@extends('admin.layouts.app')



@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('admin/assets/bundles/jquery-selectric/selectric.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('admin/assets/bundles/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
    <section class="section">
        <div class="container mt-1">
            <div class="row">
                @if (Auth::user()->roles[0]['name'] != 'boutique')
                    <a class="btn btn-primary fas fa-arrow-left mb-2" href="{{ route('user.list') }}"> Retour à la liste des
                        utilisateurs</a>
                @endif
                <div
                    class="col-12 col-sm-10 offset-sm-1 col-md-10 offset-md-2 col-lg-10 offset-lg-2 col-xl-10 offset-xl-2 m-auto">

                    <div class="card card-primary">
                        @include('admin.components.validationMessage')
                        <div>

                        </div>
                        <div class="card-header">
                            <h4>Modification utilisateur</h4>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" novalidate="" method="POST"
                                action="{{ route('user.update', $user['id']) }}" enctype="multipart/form-data">
                                @csrf
                                @if (Auth::user()->roles[0]['name'] != 'boutique')
                                    <div class="form-group col-12">
                                        <label for="password2" class="d-block">Type utilisateur</label>
                                        <select name="role" id="role" class="form-control select2" required>
                                            <option disabled selected value>Choisir un role</option>
                                            {{-- @if ($user->roles->containsStrict('id', $item['id'])) @selected(true) @endif --}}

                                            @if (Auth::user()->hasRole('developpeur'))
                                                @foreach ($roles_for_developpeur as $item)
                                                    <option value="{{ $item['name'] }}"
                                                        {{ $item['name'] == $user['role'] ? 'selected' : '' }}>
                                                        {{ $item['name'] }} </option>
                                                @endforeach
                                            @else
                                                @foreach ($roles as $item)
                                                    <option value="{{ $item['name'] }}"
                                                        {{ $item['name'] == $user['role'] ? 'selected' : '' }}>
                                                        {{ $item['name'] }} </option>
                                                @endforeach
                                            @endif

                                        </select>
                                        <div class="invalid-feedback">
                                            Champs obligatoire
                                        </div>
                                    </div>
                                    <div class="form-group col-12 fullName">
                                        <label for="frist_name">Nom & prenoms</label>
                                        <input id="fullName" value="{{ $user['name'] }}" type="text"
                                            class="form-control" name="name" autofocus required>
                                        <div class="invalid-feedback">
                                            Champs obligatoire
                                        </div>
                                    </div>
                                    @else
                                    <input type="text" hidden name="role" value="boutique"/>
                                @endif


                                <div class="row shop">
                                    <div class="form-group col-6">
                                        <label for="shopName">Nom de boutique</label>
                                        <input type="text" class="form-control" value="{{ $user['shop_name'] }}"
                                            id="shopName" name="shop_name" required>
                                        <div class="invalid-feedback">
                                            Champs obligatoire
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="shopName">Localisation (boutique) <small class="text-danger">Ex:
                                                Abidjan, cocody angre</small> </label>
                                        <input id="localisation" type="text" value="{{ $user['localisation'] }}"
                                            class="form-control" name="localisation" required>
                                        <div class="invalid-feedback">
                                            Champs obligatoire
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6 email">
                                        <label for="email">Email</label>
                                        <input id="email" value="{{ $user['email'] }}" type="email"
                                            class="form-control" name="email" required>
                                        <div class="invalid-feedback">
                                            Champs obligatoire
                                        </div>
                                    </div>

                                    <div class="form-group col-6 phone">
                                        <label for="last_name">Telephone</label>
                                        <input id="phone" value="{{ $user['phone'] }}" type="number"
                                            class="form-control" name="phone" required>
                                        <div class="invalid-feedback">
                                            Champs obligatoire
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-12 logo">
                                    <label for="logo_boutique">Logo de la boutique</label>
                                    <img id="img-preview" src="{{ $user->getFirstMediaUrl('logo') }}" width="250px"
                                        alt="{{ $user->getFirstMediaUrl('logo') }}" />
                                    <input type="file" name="logo" class="form-control" id="logo"
                                        onchange="readURL(this);">
                                </div>

                                <hr>

                                <h5 class="text-danger title_pwd"> <i class="fas fa-lock"></i> Changer son mot de passe</h5>

                                <div class="row pwd">
                                    <div class="form-group col-8">
                                        <label for="password" class="d-block">Mot de passe (<small
                                                class="text-danger">Entrer un nouveau mot de passe si vous souhaitez le
                                                modifier </small>) </label>
                                        <input id="password" type="password" class="form-control" name="password"
                                            aria-autocomplete="none" autocomplete="off">

                                    </div>

                                    <div class="form-group col-4 my-auto">
                                        @include('admin.components.hideshowpwd')

                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        Modifier
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

            var role_input = $('#role').val();
            if (role_input == 'boutique') {
                $('.fullName').hide(200);
                $('#fullName').prop("required", false);
            } else if (role_input == 'administrateur' || role_input == 'client') {
                $('.shop').hide(200);
                $('.logo').hide(200);
                $('.fullName').show(200);
                // $('.phone').show(200);
                // $('.email').show(200);
                // $('#fullName').prop("required", true);
                // $('#shopName').prop("required", false);
                // $('#localisation').prop("required", false);
            }



            $('#role').change(function(e) {
                $('#btnRegister').show(200);
                var roleSelected = $("#role option:selected").val();
                if (roleSelected === 'administrateur' || roleSelected === 'client') {
                    $('.shop').hide(200);
                    $('.logo').hide(200);
                    $('.fullName').show(200);
                    $('.phone').show(200);
                    $('.email').show(200);
                    $('#fullName').prop("required", true);
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
