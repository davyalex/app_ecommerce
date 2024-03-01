@extends('admin.layouts.app')


@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-around">
                            <h4>Produits {{ request('type') ?? request('storeName') }} </h4>
                            <a href="{{ request('store') ? route('product.create', 'store=' . request('store') . '&& storeName=' . request('storeName')) : route('product.create') }}"
                                class="btn btn-primary">Ajouter un produit</a>

                            <div class="dropdown {{ request('store')  ? 'd-none' : (Auth::user()->roles[0]['name'] == 'boutique'  ? 'd-none' : '') }}">
                                @php
                                    $type = ['normal', 'pack', 'section'];
                                @endphp
                                <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">
                                    <i class="fa fa-filter"></i>
                                    Filtre par type</a>
                                <div class="dropdown-menu">
                                    @foreach ($type as $item)
                                        <a href="/admin/product?type={{ $item }}"
                                            class="dropdown-item has-icon text-capitalize"><i
                                                class="fa fa-shopping-cart"></i>
                                            {{ $item }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        @include('admin.components.validationMessage')

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="tableExport">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>image</th>
                                            <th>Name</th>
                                            <th>categories</th>
                                            <th>prix</th>
                                            <th class="{{ request('store') ? 'd-none' : '' }}">Tarif Livraison</th>
                                            <th>date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product as $key => $item)
                                            <tr id="row_{{$item['id']}}">
                                                <td>
                                                    {{ ++$key }}
                                                </td>
                                                <td>
                                                    <img alt="{{ asset($item->getFirstMediaUrl('product_image')) }}"
                                                        src="{{ asset($item->getFirstMediaUrl('product_image')) }}"
                                                        width="35">
                                                    <br> <small># {{ $item['code'] }} </small>
                                                </td>
                                                <td>{{ $item['title'] }}</td>
                                                <td>
                                                    @foreach ($item['categories'] as $items)
                                                        <br> {{ $items['name'] }}
                                                        <small class="text-danger"><b> #type :{{ $items['type'] }}</b>
                                                        </small>
                                                    @endforeach
                                                </td>
                                                <td>{{ number_format($item['price'], 0) }} FCFA</td>
                                                <td class="{{ request('store') ? 'd-none' : '' }}">
                                                    <p>Expedition: {{ number_format($item['delivery_interieur'], 0) }} </p>
                                                    <p>Abidjan: {{ number_format($item['delivery_abidjan'], 0) }} </p>

                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($item['created_at'])->diffForHumans() }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" data-toggle="dropdown"
                                                            class="btn btn-warning dropdown-toggle">Options</a>
                                                        <div class="dropdown-menu">
                                                            <a href="{{ 'https://dooya.ci/detail/' . $item['id'] }}"
                                                                class="dropdown-item has-icon"><i class="fas fa-eye"></i>
                                                                View</a>
                                                            <a href="{{ route('product.edit', $item['id'] . '?store='.request('store')) }}"
                                                                class="dropdown-item has-icon"><i class="far fa-edit"></i>
                                                                Edit</a>

                                                            <a href="#" role="button" data-id="{{ $item['id'] }}"
                                                                class="dropdown-item has-icon text-danger delete"><i
                                                                    class="far fa-trash-alt"></i>Delete</a>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {

            $('.delete').on("click", function(e) {
                e.preventDefault();
                var Id = $(this).attr('data-id');
                swal({
                    title: "Suppression",
                    text: "Veuillez confirmer la suppression",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Confirmer",
                    cancelButtonText: "Annuler",
                }).then((result) => {
                    if (result) {
                        $.ajax({
                            type: "POST",
                            url: "/admin/product/destroy/" + Id,
                            dataType: "json",
                            data: {
                                _token: '{{ csrf_token() }}',

                            },
                            success: function(response) {
                                if (response.status === 200) {
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
                                        timer: 500,
                                        timerProgressBar: true,
                                    });
                                   $( "#row_" + Id ).remove();
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
