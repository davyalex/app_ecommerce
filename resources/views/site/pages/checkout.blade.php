@extends('site.layouts.app')

@section('title', 'Caisse')

@section('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/bundles/jquery-selectric/selectric.css') }}">

@endsection
@section('content')
    @if (session('cart'))
        @include('admin.components.validationMessage')
        <!--start to page content-->
        <div class="page-content p-0">
            <div class="card rounded-0 border-0">
                <div class="card-body">
                    <!--Resume of cart-->
                    <h5 class="fw-bold mb-3 text-dark">résumé de la commande</h5>
                    <div class="hstack align-items-center justify-content-between mb-1">
                        <p class="mb-0">Sous-total</p>
                        <p class="mb-0 subTotal">{{ number_format($total_price) }} FCFA</p>
                    </div>

                    {{-- <div class="hstack align-items-center justify-content-between mb-1">
                        <p class="mb-0">Bag discount</p>
                        <p class="mb-0 text-success">- $178.00</p>
                    </div> --}}

                    <div class="hstack align-items-center justify-content-between mb-1">
                        <p class="mb-0 ">Livraison (<span class="delivery_name"></span>)</p>
                        <p class="mb-0 delivery_price">0 FCFA</p>
                    </div>

                    <div class="hstack align-items-center justify-content-between fw-bold text-content">
                        <p class="mb-0">Total</p>
                        <p class="mb-0 total_price">{{ number_format($total_price) }} FCFA</p>
                    </div>

                    <hr>
                    <!--Personel infos-->

                    <div>
                        <h5 class="fw-bold mb-3 mt-3 text-dark">Infos personnelles</h5>

                        <div class="hstack align-items-center justify-content-between">
                            <p class="mb-0">Nom & prenoms: <span
                                    style="color:rgb(249, 112, 14); font-style:italic">{{ Auth::user()->name ? Auth::user()->name : 'non defini' }}
                                </span></p>
                            <p class="mb-0"><i class="bi bi-pencil"></i> <a class="text-dark"
                                    href="{{ route('my-profile', Auth::user()->id) }} "><i>Modifier</i></a> </p>
                        </div>

                        <div class="hstack align-items-center justify-content-between">
                            <p class="mb-0">Contact: <span class="phone"
                                    style="color:rgb(249, 112, 14); font-style:italic">{{ Auth::user()->phone ? Auth::user()->phone : 'non defini' }}
                                </span></p>
                            <p class="mb-0"><i class="bi bi-pencil"></i> <a class="text-dark"
                                    href="{{ route('my-profile', Auth::user()->id) }} "><i>Modifier</i></a> </p>
                        </div>

                        <div class="hstack align-items-center justify-content-between">
                            <p class="mb-0">Email: <span
                                    style="color:rgb(249, 112, 14); font-style:italic">{{ Auth::user()->email ? Auth::user()->email : 'non defini' }}
                                </span></p>
                            <p class="mb-0"><i class="bi bi-pencil"></i> <a class="text-dark"
                                    href="{{ route('my-profile', Auth::user()->id) }} "><i>Modifier</i></a> </p>
                        </div>
                    </div>

                    <hr>
                    <!--Details delivery-->

                    <h5 class="mb-0 text-dark mb-3">Details de livraison</h5>
                    <div class="text-danger delivery_error">
                        Veuillez choisir une zone de livraison
                    </div>
                    <form class="row g-3 needs-validation">
                        <div class="col-12">
                            <div class="form-floating form-group">
                                <select class="form-control rounded-3 delivery selectric" name="delivery"
                                    id="floatingCountry">
                                    <option disabled value selected> Choisir un lieu de livraison</option>

                                    @foreach ($delivery as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['zone'] }} </option>
                                    @endforeach
                                </select>

                                <label for="floatingCountry">Zone de livraison</label>


                            </div>
                        </div>

                       
                    </form><!--end form-->

                    <hr>

                    @if (session('cart'))
                        <div class="hstack align-items-center justify-content-center w-100 py-3 align-items-stretch">
                            <div class="short-by d-flex align-items-center justify-content-center">
                                <a href="{{ route('category-list') }}" class="btn btn-ecomm">Continuer mes achats</a>
                            </div>
                            <div class="vr"></div>
                            <div class="filter-btn bg-dark  d-flex align-items-center justify-content-center">
                                <a href="" class="btn btn-ecomm text-white validOrder">Valider la commande</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!--end to page content-->
    @endif

@section('js')
    <script src="{{ asset('admin/assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>

@endsection
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>

<script>
    //hide msg error delivery
    $('.delivery_error').hide();

    $('#floatingCountry').change(function(e) {
        e.preventDefault();
        // var zone_name = $('#floatingCountry option:selected').html();
        // var zone_price = $('#floatingCountry option:selected').val();
        var zone_id = $('#floatingCountry option:selected').val();
        console.log(zone_id);
        //refresh deivery name
        // $('.delivery').html(zone_name)

        var total = {{ Js::from($total_price) }};

        $.ajax({
            type: "GET",
            url: "/refresh-shipping/" + zone_id,
            data: {
                sub_total: total
            },
            dataType: "json",
            success: function(response) {
                console.log(response);
                $('.delivery_price').html(response.delivery_price)
                $('.total_price').html(response.total_price)
                $('.delivery_name').html(response.delivery_name)

            }
        });


    });


    $('.validOrder').click(function(e) {
        e.preventDefault();
        var phone = {{ Js::from(Auth::user()->phone) }}
        var phone = phone !== null ? true : false;

        var zone_id = $('#floatingCountry option:selected').val();

        if (!zone_id) {
            $('.delivery_error').show(500);

        } else if (phone == false) {

            Swal.fire({
                text: "Veuillez ajouter un numero de telephone, clique sur modifier",
                // icon: 'warning',
                width: '350px',
                showCancelButton: false,
                confirmButtonColor: '#212529',
                cancelButtonColor: '#212529',
                confirmButtonText: 'Choisir'
            })
        } else {

            //send data to back
            var subTotal = $('.subTotal').html();
            var delivery_name = $('.delivery_name').html();
            var delivery_price = $('.delivery_price').html();
            var total_price = $('.total_price').html();
            var options = $('.total_price').html();



            var data = {
                subTotal,
                delivery_name,
                delivery_price,
                total_price,
            }

            $.ajax({
                type: "GET",
                url: "save-order",
                data: {
                    data
                },
                dataType: "json",
                success: function(response) {

                    if (response.status === 200) {
                        let timerInterval
                        Swal.fire({
                            title: 'Enregistrement de la commande',
                            html: 'Veuillez patienter dans <b></b> Secondes.',
                            timer: 5000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                const b = Swal.getHtmlContainer().querySelector('b')
                                timerInterval = setInterval(() => {
                                    b.textContent = Swal.getTimerLeft()
                                }, 100)
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                window.location.href = "{{ route('my-order') }}";
                            }
                        })

                    }
                }
            });




        }

    });
</script>
@endsection
