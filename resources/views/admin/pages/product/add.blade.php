@extends('admin.layouts.app')

@section('content')
    <style>
        input[type="file"] {
            display: block;
        }

        .imageThumb {
            /* position:absolute; */
            max-height: 75px;
            border: 2px solid;
            padding: 1px;
            cursor: pointer;
        }

        .pip {
            display: inline-block;
            margin: 10px 10px 0 0;
            color: rgb(255, 255, 255)
        }

        .remove {
            top: -85px;
            width: 30px;
            position: relative;
            display: block;
            background: #ffff;
            border-radius: 20px;
            border: 1px solid rgb(255, 255, 255);
            color: rgb(59, 59, 61);
            text-align: center;
            cursor: pointer;
            box-shadow: 3px 4px rgb(188, 188, 188);
        }

        .remove:hover {
            background: white;
            color: black;
        }
    </style>

@section('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/bundles/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/bundles/select2/dist/css/select2.min.css') }}">
@endsection
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Ajouter un produit</h4>
                    </div>
                    @include('admin.components.validationMessage')

                    <form class="needs-validation" novalidate="" action="{{ route('product.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row mb-3">
                                <label for="" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Type
                                    de produit</label>

                                <div class="col-sm-12 col-md-7">
                                    <select name="type" id="categoryType" class="form-control  select2" required>
                                        <option></option>
                                        <option value="normal">Normal</option>
                                        <option value="pack">Pack</option>
                                        <option value="section">Section</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Champs obligatoire
                                    </div>
                                </div>
                                {{-- <button type="button" data-toggle="modal" data-target="#modalAddCategory"
                                    class="btn btn-primary"><i data-feather="plus"></i> </button> --}}
                            </div>
                            
                            <div class="form-group row mb-3">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Titre du
                                    produit</label>
                                <div class="col-sm-12 col-md-7">
                                    <input name="title" type="text" placeholder="Ex: matelas super dooya"
                                        class="form-control" required>
                                    <div class="invalid-feedback">
                                        Champs obligatoire
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Prix</label>
                                <div class="col-sm-12 col-md-7">
                                    <input name="price" type="number" placeholder="Ex: 30000"
                                        class="form-control currency" required>
                                    <div class="invalid-feedback">
                                        Champs obligatoire
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-3 catDiv">
                                <label for=""
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Categorie</label>

                                <div class="col-sm-12 col-md-7">
                                    <select name="categories" class="form-control select2 catDiv" required>
                                        <option value="">Selectionner une catégorie</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item['id'] }}"> {{ $item['name'] }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Champs obligatoire
                                    </div>
                                </div>
                                {{-- <button type="button" data-toggle="modal" data-target="#modalAddCategory"
                                    class="btn btn-primary"><i data-feather="plus"></i> </button> --}}
                            </div>



                            <div class="form-group row mb-3 subcat  subCatDiv">
                                <label for="" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Sous
                                    categorie</label>

                                <div class="col-sm-12 col-md-7">
                                    <select style="width: 520px" name="subcategories"
                                        class="form-control select2 subCat_required  subCatDiv" required>
                                        @foreach ($subcategories as $item)
                                            {{-- <option value="{{ $item['id'] }}"> {{ $item['name'] }} </option> --}}
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Champs obligatoire
                                    </div>
                                </div>

                            </div>

                            <div class="form-group row mb-3 sectionDiv" id="">
                                <label for=""
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Section
                                    Categorie</label>

                                <div class="col-sm-12 col-md-7">
                                    <select style="width: 520px" name="category_section[]" class="form-control select2 sectionDiv"
                                        multiple required>
                                        <option></option>
                                        @foreach ($section_categories as $item)
                                            <option value="{{ $item['id'] }}"> {{ $item['name'] }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Champs obligatoire
                                    </div>
                                </div>

                            </div>

                            <div class="form-group row mb-3 packDiv" id="">
                                <label for="" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pack
                                    Categorie</label>

                                <div class="col-sm-12 col-md-7">
                                    <select style="width: 520px" name="categories" class="form-control select2 packDiv"
                                        required>
                                        <option></option>

                                        @foreach ($pack_categories as $item)
                                            <option value="{{ $item['id'] }}"> {{ $item['name'] }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Champs obligatoire
                                    </div>
                                </div>

                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Description</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea name="description" class="summernote-simple"></textarea>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Images</label>
                                <div class="col-sm-12 col-md-7">
                                    <p class="card-text">
                                        <input type="file" id="files" class="form-control" name="files[]"
                                            accept="image/*" multiple hidden required />
                                        <label for="files" class="btn btn-light btn-lg border">
                                            <i data-feather="image"></i>
                                            Ajoutez des images</label>
                                    <div class="invalid-feedback">Champs obligatoire</div>
                                    </p>

                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7 text-lg-right">
                                    <button type="submit" class="btn btn-primary w-100">Enregistrer</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


@section('script')
    <script src="{{ asset('admin/assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
@endsection
<script type="text/javascript">
    $(document).ready(function() {

        // Gestion upload image
        if (window.File && window.FileList && window.FileReader) {
            $("#files").on("change", function(e) {
                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $("<span class=\"pip\">" + "<span class=\"pip\">" +
                            "<img class=\"imageThumb\" src=\"" + e.target.result +
                            "\" title=\"" + file
                            .name + "\"/>" +
                            "<br/><span class=\"remove\">x</span>" +
                            "</span>").insertAfter("#files");
                        $(".remove").click(function() {
                            $(this).parent(".pip").remove();
                        });

                        // Old code here
                        /*$("<img></img>", {
                          class: "imageThumb",
                          src: e.target.result,
                          title: file.name + " | Click to remove"
                        }).insertAfter("#files").click(function(){$(this).remove();});*/

                    });
                    fileReader.readAsDataURL(f);
                }
            });
        } else {
            alert("Your browser doesn't support to File API")
        }

        //load sub cat
        $('.subcat').hide();

        $('select[name="categories"]').on('change', function() {
            var catId = $(this).val();
            if (catId) {
                $.ajax({
                    url: '/admin/product/loadSubCat/' + catId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="subcategories"]').empty();
                        $('select[name="subcategories"]')
                            .append(
                                '<option value="" selected disabled value>Selectionner une sous categorie</option>'
                            );
                        $.each(data, function(key, value) {
                            $('select[name="subcategories"]').append(
                                '<option value=" ' + value
                                .id + '">' + value.name + '</option>');
                            // console.log(key, value.title);
                        })

                        if (data.length > 0) {
                            $('.subcat').show(200);
                            $('.subCat_required').prop('required', true);


                        } else {
                            $('.subcat').hide(200);
                            $('.subCat_required').prop('required', false);
                        }
                    }

                })
            } else {
                $('select[name="subcategories"]').empty();
            }
        });


        //afficher les element en fonction du type



        $('#categoryType').on('change', function() {
            var selectVal = $("#categoryType option:selected").val();
            if (selectVal === 'pack') {
                $('.packDiv').show(200);
                $('.catDiv').hide(200);
                $('.subCatDiv').hide(200);
                $('.sectionDiv').hide(200);
                $('.catDiv').prop("required", false);
                $('.subCatDiv').prop("required", false);
                $('.sectionDiv').prop("required", false);

            } else if (selectVal === 'section') {
                $('.sectionDiv').show(200);
                $('.catDiv').hide(200);
                $('.subCatDiv').hide(200);
                $('.packDiv').hide(200);
                $('.catDiv').prop("required", false);
                $('.subCatDiv').prop("required", false);
                $('.packDiv').prop("required", false);

            } else if (selectVal === 'normal') {
                $('.catDiv').show(200);
                $('.subCatDiv').show(200);
                $('.packDiv').hide(200);
                $('.sectionDiv').hide(200);
                $('.sectionDiv').prop("required", false);
                $('.packDiv').prop("required", false);
            }

        });

    });
</script>
@endsection
