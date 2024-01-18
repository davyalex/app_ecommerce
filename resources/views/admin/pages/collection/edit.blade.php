@extends('admin.layouts.app')

@section('content')
    <style>
        img {
            max-width: 180px;
        }

        input[type=file] {
            padding: 10px;
            background: #eaeaea;
        }
    </style>

<section class="section">
    @php
        $msg_validation = 'Champs obligatoire'
    @endphp
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-6 col-lg-8 m-auto">
            @include('admin.components.validationMessage')
          <div class="card">
            <form action="{{ route('collection.update', $collection['id']) }}" class="needs-validation" novalidate="" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" value="{{$collection['name']}}"  class="form-control" required="">
                        <div class="invalid-feedback">
                           {{$msg_validation}}
                         </div>
                    </div>
                </div>
    
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">collection
                        image</label>
                    <div class="col-sm-9">
                        <img id="_blah" src="{{ $collection->getFirstMediaUrl('collection_image') }}" alt="{{ $collection->getFirstMediaUrl('collection_image') }}" />
                        <input type="file" name="collection_img" class="form-control" onchange="_readURL(this);">
                    </div>
                </div>
    
                {{-- <div class="form-group row">
                    <label class="col-sm-3 col-form-label">collection
                        banner</label>
                    <div class="col-sm-9">
                        <img id="blah" src="http://placehold.it/180" alt="your image" />
                        <input type="file" name="cat_banner" class="form-control" onchange="readURL(this);">
                       
                    </div>
                </div>
     --}}
    
    
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
          </div>
        
        </div>
      
      </div>
    </div>
  </section>
  

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };


                reader.readAsDataURL(input.files[0]);
            }
        }

        // ######################
        function _readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#_blah')
                        .attr('src', e.target.result);
                };


                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
