@extends('site.layouts.app')

@section('title', 'Panier')

@section('content')

    {{-- style --}}
    <style>
        * {
            box-sizing: border-box;
        }



        .quantity {
            display: flex;
            /* border: 2px solid #3498db; */
            border-radius: 4px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .quantity button {
            background-color: #212529;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 20px;
            width: 30px;
            height: auto;
            text-align: center;
            transition: background-color 0.2s;
        }

        .quantity button:hover {
            background-color: ##212529;
        }

        .input-box {
            width: 40px;
            text-align: center;
            border: none;
            padding: 8px 10px;
            font-size: 16px;
            outline: none;
        }

        /* Hide the number input spin buttons */
        .input-box::-webkit-inner-spin-button,
        .input-box::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .input-box[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
    {{-- End style --}}



    @php $total = 0 @endphp

    @if (session('cart'))
        <!--start to page content-->
        <div class="page-content">


            <!--start cart list-->
            <div class="cart-list d-flex flex-column gap-4">
                @foreach (session('cart') as $id => $details)
                    @php $total += $details['price'] * $details['quantity'] @endphp

                    <div class="card rounded-3 overflow-hidden cartDiv" data-id="{{ $id }}">
                        <div class="card-body" style="font-style: italic">
                            <div class="d-flex flex-row align-items-start align-items-stretch gap-3">
                                <div class="product-img">
                                    <a href="{{ route('product-detail', $details['id']) }}">
                                        <img src="{{ $details['image'] }}" class="rounded-3" width="100" alt="">
                                    </a>
                                </div>
                                <div class="product-info flex-grow-1">
                                    <h6 class="fw-bold mb-0 text-dark">{{ $details['title'] }}</h6>
                                    <div class="product-price d-flex align-items-center gap-2 mt-2">
                                        <div class="fw-bold text-dark">{{ number_format($details['price'], 0) }} FCFA</div>
                                    </div>

                                    <div class="mt-2 hstack gap-3">
                                        <small>{{ $details['options'] && is_numeric($details['options'][0]) ? 'Pointure: ' : ($details['options'] && ctype_alpha($details['options'][0]) ? 'Taille:' : '') }}
                                            @if ($details['options'])
                                                @foreach ($details['options'] as $item)
                                                    {{ $item }}
                                                @endforeach
                                            @endif

                                        </small>
                                        <small class="qte">Quantité: {{ $details['quantity'] }} </small>

                                        {{-- Qté : <input type="number" style="width: 30%" value="{{$details['quantity']}}" class="form-control col-sm-4"> --}}
                                        {{-- <div class="quantity">
                                            <button class="minus" aria-label="Decrease">&minus;</button>
                                            <input type="number" class="input-box" value="1" min="1" max="10">
                                            <button class="plus" aria-label="Increase">&plus;</button>
                                          </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent p-0">
                            <div class="d-flex align-items-center gap-3 justify-content-between">
                                <div class="d-grid flex-fill">
                                    <button data-id="{{ $id }}"
                                        class="btn btn-ecomm text-dark text-capitalize remove-from-cart"> <i
                                            class="bi bi-trash"></i>
                                        <i>Supprimer</i></button>
                                </div>
                                <div class="vr"></div>

                                <div class="d-grid flex-fill">
                                    <div class="quantity m-auto">
                                        <button id="decrease" onclick="decreaseValue({{ $id }})"
                                            class="minus update-cart" aria-label="Decrease" @readonly(true)>&minus;</button>
                                        <input type="number" id="{{ $id }}" class="input-box update-cart"
                                            value="{{ $details['quantity'] }}" min="1" max="100">
                                        <button id="increase" onclick="increaseValue({{ $id }})"
                                            class="plus update-cart" aria-label="Increase" @readonly(true)>&plus;</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div><!--end cart list-->


            <!--start invoice summery-->
            {{-- <div class="card rounded-3 my-3">
                <div class="card-body">
                    <h5 class="mb-3 text-dark"><i>Appliquer un Coupon</i></h5>
                    <form>
                        <div class="mb-3">
                            <input type="email" class="form-control rounded-3" id="ApplyCouponCode"
                                placeholder="Entrer Coupon Code" required>
                        </div>
                        <div class="mb-0 d-grid">
                            <button type="submit" class="btn btn-dark btn-ecomm rounded-3">Valider</button>
                        </div>
                    </form>
                </div>
            </div> --}}
            <div class="card rounded-3 mt-3">
                <div class="card-body">
                    {{-- <h5 class="fw-bold mb-3 text-dark">résumé de la commande</h5>
                    <div class="hstack align-items-center justify-content-between">
                        <p class="mb-0">Bag Total</p>
                        <p class="mb-0">$599.00</p>
                    </div>
                    <hr>
                    <div class="hstack align-items-center justify-content-between">
                        <p class="mb-0">Bag discount</p>
                        <p class="mb-0 text-success">- $178.00</p>
                    </div>
                    <hr>
                    <div class="hstack align-items-center justify-content-between">
                        <p class="mb-0">Delivery</p>
                        <p class="mb-0">$29.00</p>
                    </div>
                    <hr> --}}
                    <div class="hstack align-items-center justify-content-between fw-bold text-content">
                        <p class="mb-0">Sous-total</p>
                        <p class="mb-0">{{ number_format($total) }} FCFA </p>
                    </div>

                </div>
            </div>
            <!--start invoice summery-->

        </div>
        <!--end to page content-->
    @else
        <h4 class="" style="margin-top:150px; text-align:center">Votre panier est vide</h4>
        <div class="filter-btn bg-dark w-100 d-flex align-items-center justify-content-center">
            <a href="{{ route('category-list') }}" class="btn btn-ecomm text-white">Ajouter un produit au panier</a>
        </div>
    @endif

    <!--start to footer-->
    {{-- <footer class="page-footer  border-top d-flex align-items-center px-0"> --}}
    @if (session('cart'))
        <div class="hstack align-items-center justify-content-center w-100 align-items-stretch"
            style="margin-bottom: 100px">
            <div class="short-by d-flex align-items-center justify-content-center">
                <a href="{{ route('category-list') }}" class="btn btn-ecomm">Continuer mes achats</a>
            </div>
            <div class="vr"></div>
            <div class="filter-btn bg-dark  d-flex align-items-center justify-content-center">
                <a href="{{ route('checkout') }}" class="btn btn-ecomm text-white">Finaliser la commande</a>
            </div>
        </div>
    @endif

    {{-- </footer> --}}
    <!--end to footer-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <script>
        function increaseValue(id) {
            var value = parseInt(document.getElementById(id).value);
            value = isNaN(value) ? 0 : value;
            value++;
            document.getElementById(id).value = value;


            let IdProduct = id;

            $.ajax({
                url: '{{ route('update.cart') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: IdProduct,
                    quantity: value
                },
                success: function(response) {
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: 'Quantité modifié avec succès',
                        animation: false,
                        position: 'top-right',
                        background: '#3da108e0',
                        iconColor: '#fff',
                        color: '#fff',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                    });

                    window.location.reload();
                }
            });
        }



        function decreaseValue(id) {
            var value = parseInt(document.getElementById(id).value, 10);
            value = isNaN(value) ? 0 : value;
            value < 1 ? value = 1 : '';
            value--;

            let IdProduct = id;
            document.getElementById(id).value = value;
            $.ajax({
                url: '{{ route('update.cart') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: IdProduct,
                    quantity: value
                },
                success: function(response) {
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: 'Panier mis à jour avec succès',
                        animation: false,
                        position: 'top',
                        background: '#3da108e0',
                        iconColor: '#fff',
                        color: '#fff',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                    });

                    window.location.reload();
                }
            });

        }

        //remove product from cart
        $(".remove-from-cart").click(function(e) {
            e.preventDefault();

            var productId = e.target.dataset.id;

            Swal.fire({
                title: 'Retirer du panier',
                text: "Voulez-vous vraiment supprimer ce article du panier ?",
                // icon: 'warning',
                width: '350px',
                showCancelButton: true,
                confirmButtonColor: '#212529',
                cancelButtonColor: '#212529',
                confirmButtonText: 'Oui, supprimer'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('remove.from.cart') }}',
                        method: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: productId
                        },
                        success: function(response) {

                            Swal.fire({
                                toast: true,
                                icon: 'success',
                                title: 'Le produit a été retiré du panier',
                                animation: false,
                                position: 'top',
                                background: '#3da108e0',
                                iconColor: '#fff',
                                color: '#fff',
                                showConfirmButton: false,
                                timer: 1000,
                                timerProgressBar: true,
                            });
                            setTimeout(function() {
                                window.location.href = "{{ route('cart') }}";
                            }, 1000);
                        }
                    });


                }
            })


        });



        //quantity function
        // (function() {
        //     const quantityContainer = document.querySelector(".quantity");
        //     const minusBtn = quantityContainer.querySelector(".minus");
        //     const plusBtn = quantityContainer.querySelector(".plus");
        //     const inputBox = quantityContainer.querySelector(".input-box");

        //     updateButtonStates();

        //     quantityContainer.addEventListener("click", handleButtonClick);
        //     inputBox.addEventListener("input", handleQuantityChange);

        //     function updateButtonStates() {
        //         const value = parseInt(inputBox.value);
        //         minusBtn.disabled = value <= 1;
        //         plusBtn.disabled = value >= parseInt(inputBox.max);
        //     }

        //     function handleButtonClick(event) {
        //         if (event.target.classList.contains("minus")) {
        //             decreaseValue();
        //         } else if (event.target.classList.contains("plus")) {
        //             increaseValue();
        //         }
        //     }

        //     function decreaseValue() {
        //         let value = parseInt(inputBox.value);
        //         value = isNaN(value) ? 1 : Math.max(value - 1, 1);
        //         inputBox.value = value;
        //         updateButtonStates();
        //         handleQuantityChange();
        //     }

        //     function increaseValue() {
        //         let value = parseInt(inputBox.value);
        //         value = isNaN(value) ? 1 : Math.min(value + 1, parseInt(inputBox.max));
        //         inputBox.value = value;
        //         updateButtonStates();
        //         handleQuantityChange();
        //     }

        //     function handleQuantityChange() {
        //         let value = parseInt(inputBox.value);
        //         value = isNaN(value) ? 1 : value;

        //         // Execute your code here based on the updated quantity value

        //         console.log("Quantity changed:", value);

        //         let IdProduct = $('.cartDiv').attr("data-id");

        //         $.ajax({
        //             url: '{{ route('update.cart') }}',
        //             method: "patch",
        //             data: {
        //                 _token: '{{ csrf_token() }}',
        //                 id: IdProduct,
        //                 quantity: value
        //             },
        //             success: function(response) {
        //                 Swal.fire({
        //                     toast: true,
        //                     icon: 'success',
        //                     title: 'Quantité modifié avec succès',
        //                     animation: false,
        //                     position: 'top-right',
        //                     background: '#3da108e0',
        //                     iconColor: '#fff',
        //                     color: '#fff',
        //                     showConfirmButton: false,
        //                     timer: 2000,
        //                     timerProgressBar: true,
        //                 });

        //                 window.location.reload();
        //             }
        //         });

        //     }
        // })();


        // $(".update-cart").change(function(e) {
        //     e.preventDefault();
        //     alert('eeeeee')
        //     var ele = $(this);

        //     id = ele.parents("div").attr("data-id");

        //     $.ajax({
        //         url: '{{ route('update.cart') }}',
        //         method: "patch",
        //         data: {
        //             _token: '{{ csrf_token() }}',
        //             id: ele.parents("tr").attr("data-id"),
        //             quantity: ele.parents("tr").find(".quantity").val()
        //         },
        //         success: function(response) {
        //             window.location.reload();
        //         }
        //     });
        // });
    </script>
@endsection
