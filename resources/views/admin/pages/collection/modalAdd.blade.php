  <style>
      img {
          max-width: 180px;
      }

      input[type=file] {
          padding: 10px;
          background: #eaeaea;
      }
  </style>

  <script>
   //Change this to your no-image file
let __noimage =
  "https://ami-sni.com/wp-content/themes/consultix/images/no-image-found-360x250.png";

function __readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $("#__img-preview").attr("src", e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  } else {
    $("#img-preview").attr("src", __noimage);
  }
}

  </script>


  <!-- Modal with form -->
  <div class="modal fade" id="modalAddCollection" tabindex="-1" role="dialog" aria-labelledby="formModal"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="formModal">New collection</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="{{ route('collection.store') }}" class="needs-validation" novalidate="" method="post"
                      enctype="multipart/form-data">
                      @csrf
                      <div class="card-body">
                          <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Name</label>
                              <div class="col-sm-9">
                                  <input type="text" name="name" class="form-control" required="">
                                  <div class="invalid-feedback">
                                      enter collection name
                                  </div>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label class="col-sm-3 col-form-label">collection image</label>
                              <div class="col-sm-9">
                                <img id="__img-preview" src="https://ami-sni.com/wp-content/themes/consultix/images/no-image-found-360x250.png" width="250px" />
                                <div>
                                  <input type="file" name="collection_img" accept="image/*" onchange="__readURL(this)" />
                                </div>
                              </div>
                          </div>

                      </div>
                      <div class="card-footer text-right">
                          <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
