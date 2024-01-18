@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @include('admin.components.validationMessage')
                        <div class="card-header">
                            <h4>Utilisateurs</h4>
                            <div class="dropdown">
                                <a href="{{route('user.register')}}" class="btn btn-primary">Ajouter un
                                    utilsateur</a>
                                {{-- <div class="dropdown-menu">
                                    <a href="{{ route('user.register') }}" class="dropdown-item has-icon"><i
                                            class="fas fa-users"></i>
                                        Gestionnaires</a>
                                    <a href="/admin/auth/register?u=fournisseur" class="dropdown-item has-icon"><i
                                            class="fas fa-users"></i>
                                        Fournisseurs</a>



                                </div> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nom</th>
                                            <th>Contact</th>
                                            <th>Email</th>
                                            <th>Boutique</th>
                                            <th>Localisation</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $item)
                                            <tr>
                                                <td>{{ ++$key }} </td>
                                                <td>{{ $item['name'] }}</td>
                                                <td>{{ $item['phone'] }}</td>
                                                <td>{{ $item['email'] }}</td>
                                                <td>  {{ $item['shop_name'] }} </td>
                                                <td>{{ $item['localisation'] }} </td>
                                                <td>
                                                    @foreach ($item['roles'] as $role)
                                                        <br> <span
                                                            class="text-capitalize fw-bold">{{ $role['name'] }}</span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" data-toggle="dropdown"
                                                            class="btn btn-warning dropdown-toggle">Options</a>
                                                        <div class="dropdown-menu">
                                                            <a href="/admin/product/add?user={{ $item['id'] }}"
                                                                class="dropdown-item has-icon"><i class="fas fa-plus"></i>
                                                                Ajouter un produit</a>

                                                            <a href="#" class="dropdown-item has-icon"><i
                                                                    class="fas fa-eye"></i> View</a>
                                                            <a href="{{ route('user.edit', $item['id']) }}"
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
                            url: "/admin/auth/destroy/" + Id,
                            dataType: "json",
                            data: {
                                _token: '{{ csrf_token() }}',

                            },
                            success: function(response) {
                                if (response.status === 200) {
                                    Swal.fire({
                                        toast: true,
                                        icon: 'success',
                                        title: 'Utilisateur supprimé avec success',
                                        animation: false,
                                        position: 'top',
                                        background: '#3da108e0',
                                        iconColor: '#fff',
                                        color: '#fff',
                                        showConfirmButton: false,
                                        timer: 500,
                                        timerProgressBar: true,
                                    });
                                    setTimeout(function() {
                                        window.location.href =
                                            "{{ route('user.list') }}";
                                    }, 500);
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
