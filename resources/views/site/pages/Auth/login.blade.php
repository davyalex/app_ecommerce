@extends('site.layouts.app')

@section('title', 'Se connecter')

@section('content')

    <style>
        input[type='number'] {
            -moz-appearance: textfield;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        .button-g {
            max-width: 320px;
            display: flex;
            padding: 0.5rem 1.4rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
            font-weight: 700;
            text-align: center;
            /* text-transform: capitalize; */
            vertical-align: middle;
            align-items: center;
            border-radius: 0.5rem;
            border: 1px solid rgba(0, 0, 0, 0.25);
            gap: 0.75rem;
            color: rgb(65, 63, 63);
            background-color: #fff;
            cursor: pointer;
            transition: all .6s ease;
        }

        .button-g svg {
            height: 24px;
        }

        .button-g:hover {
            transform: scale(1.02);
        }



        .button-f {
            display: flex;
            background-color: #039be5;
            background-image: linear-gradient(to top right, #0163E0, #18ACFE);
            color: #ffffff;
            padding: 0.5rem 1.4rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
            font-weight: 700;
            text-align: center;
            vertical-align: middle;
            align-items: center;
            border-radius: 0.5rem;
            gap: 0.75rem;
            border: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            cursor: pointer;
            transition: .6s ease;
        }

        .button-f svg {
            height: 30px;
        }

        .button-f:hover {
            box-shadow: none;
        }
    </style>
    <!--start to page content-->
    @guest
        <div class="page-content">

            <div class="login-body">
                @include('admin.components.validationMessage')
                <h5 class="fw-bold">Bienvenue</h5>
                <p class="mb-0">Connectez-vous à votre compte pour continuer vos achats

                </p>
                <form class="mt-4 needs-validation" method="POST" action="{{ route('login') }}" novalidate>
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control rounded-3" id="floatingInputEmail"
                            placeholder="name@example.com" required>
                        <label for="floatingInputEmail">Email</label>
                        <div class="invalid-feedback">
                            Champs obligatoire
                        </div>
                    </div>

                    <div class="input-group mb-3" id="show_hide_password">
                        <div class="form-floating flex-grow-1">
                            <input type="password" name="password" class="form-control rounded-3 rounded-end-0 border-end-0"
                                id="floatingInputPassword" placeholder="Enter Password" required>
                            <label for="floatingInputPassword">Password</label>
                            <div class="invalid-feedback">
                                Champs obligatoire
                            </div>
                        </div>
                        <span class="input-group-text bg-transparent rounded-start-0 rounded-3"><i
                                class="bi bi-eye-slash"></i></span>
                    </div>
                    <input type="text" name="url_previous" value="{{ url()->previous() }}" hidden>


                    {{-- <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">Se souvenir de moi</label>
                        </div>
                        <div class=""><a href="authentication-otp-varification.html" class="forgot-link">Mot de passe
                                oublié?</a></div>
                    </div> --}}
                    <div class="mb-0 d-grid">
                        <button type="submit" class="btn btn-dark btn-ecomm rounded-3">Valider</button>
                    </div>
                    {{-- <div class="separator my-4">
                        <div class="line"></div>
                        <p class="mb-0 fw-bold px-3">Ou</p>
                        <div class="line"></div>
                    </div> --}}

                </form>
                {{-- <div class="social-login d-flex flex-row gap-2 justify-content-center">

                    <button role="button" class="button-g">
                        <svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" viewBox="0 0 256 262">
                            <path fill="#4285F4"
                                d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027">
                            </path>
                            <path fill="#34A853"
                                d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1">
                            </path>
                            <path fill="#FBBC05"
                                d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782">
                            </path>
                            <path fill="#EB4335"
                                d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251">
                            </path>
                        </svg>
                        Se connecter avec Google
                    </button>
                    <button role="button" class="button-f">
                        <svg stroke="#ffffff" xml:space="preserve" viewBox="-143 145 512 512"
                            xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" id="Layer_1"
                            version="1.1" fill="#ffffff">
                            <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                            <g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M329,145h-432c-22.1,0-40,17.9-40,40v432c0,22.1,17.9,40,40,40h432c22.1,0,40-17.9,40-40V185C369,162.9,351.1,145,329,145z M169.5,357.6l-2.9,38.3h-39.3v133H77.7v-133H51.2v-38.3h26.5v-25.7c0-11.3,0.3-28.8,8.5-39.7c8.7-11.5,20.6-19.3,41.1-19.3 c33.4,0,47.4,4.8,47.4,4.8l-6.6,39.2c0,0-11-3.2-21.3-3.2c-10.3,0-19.5,3.7-19.5,14v29.9H169.5z">
                                </path>
                            </g>
                        </svg>
                        Se connecter avec Facebook
                    </button>

                </div> --}}

            </div>
            <!--start to footer-->
            <p class="mb-0 rounded-0 mt-3 text-center">Vous n'avez pas de compte? <a href="{{ route('register-form') }}"
                    class="text-danger">S'inscrire</a></p>

            <!--end to footer-->
        </div>
    @endguest

    <!--end to page content-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()

        //redirect link button
        $('.button-g').click(function(e) {
            window.location.href = "{{ route('socialite.redirect', 'google') }}"
        });
        $('.button-f').click(function(e) {
            window.location.href = "{{ route('socialite.redirect', 'facebook') }}"
        });
    </script>

@endsection
