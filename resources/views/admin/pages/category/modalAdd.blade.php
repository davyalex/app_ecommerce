  <style>
      img {
          max-width: 180px;
      }

      input[type=file] {
          padding: 10px;
          background: #eaeaea;
      }
  </style>




  <!-- Modal with form -->
  <div class="modal fade" id="modalAddCategory" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="formModal">New category</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="{{ route('category.store') }}" class="needs-validation" novalidate="" method="post"
                      enctype="multipart/form-data">
                      @csrf

                      <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Type</label>
                          <div class="col-sm-9">
                              <select name="type" id="categoryType" class="form-control selectric " required>
                                  <option disabled selected value>Choisir un type</option>
                                  <option value="principale">Principale</option>
                                  <option value="section">Section</option>
                                  <option value="pack">Pack</option>

                              </select>
                              <div class="invalid-feedback">
                                  Champ obligatoire
                              </div>

                          </div>
                      </div>
                      <div class="card-body">
                          <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Name</label>
                              <div class="col-sm-9">
                                  <input type="text" name="name" class="form-control" required="">
                                  <div class="invalid-feedback">
                                      Champ obligatoire
                                  </div>
                              </div>
                          </div>

                          {{-- <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Type d'affichage</label>
                              <div class="col-sm-9">
                                  <select name="type_affichage" class="form-control selectric " required>
                                      <option disabled selected value>Choisir un type d'affichage</option>
                                      <option value="bloc">bloc</option>
                                      <option value="carrousel">carrousel</option>
                                  </select>
                                  <div class="invalid-feedback">
                                      Champ obligatoire
                                  </div>

                              </div>
                          </div> --}}

                          <div class="form-group row categoryImage">
                              <label class="col-sm-3 col-form-label">category image (500 * 500) </label>
                              <div class="col-sm-9">
                                  <img id="img-preview"
                                      src="https://ami-sni.com/wp-content/themes/consultix/images/no-image-found-360x250.png"
                                      width="250px" />
                                  <input type="file" name="cat_img" class="form-control" id="cat_image"
                                      onchange="readURL(this);" required="">
                                  <div class="invalid-feedback">
                                      enter category image
                                  </div>
                              </div>
                          </div>

                          <div class="form-group row categoryBanner">
                              <label class="col-sm-3 col-form-label">category banner (1440 * 320) </label>
                              <div class="col-sm-9">
                                  <img id="_img-preview"
                                      src="https://ami-sni.com/wp-content/themes/consultix/images/no-image-found-360x250.png"
                                      width="250px" />
                                  <input type="file" name="cat_banner" class="form-control" id="cat_banner"
                                      onchange="_readURL(this);" required="">
                                  <div class="invalid-feedback">
                                      enter category banner
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


  <script>
     // ###################### categorie image
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

      // ###################### banner image
      function _readURL(input) {
          let _noimage =
              "https://ami-sni.com/wp-content/themes/consultix/images/no-image-found-360x250.png";
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function(e) {
                  $('#_img-preview')
                      .attr('src', e.target.result);
              };


              reader.readAsDataURL(input.files[0]);
          } else {
              $("#_img-preview").attr("src", _noimage);
          }
      }

      //afficher les element en fonction du type
      $('#categoryType').on('change', function() {
          var selectVal = $("#categoryType option:selected").val();
          if (selectVal === 'pack' || selectVal === 'section') {
              $('.categoryImage').hide(200);
              $('.categoryBanner').hide(200);
              $('#cat_image').prop("required", false);
              $('#cat_banner').prop("required", false);
          } else {
              $('.categoryImage').show(200);
              $('.categoryBanner').show(200);
              $('#cat_image').prop("required", true);
              $('#cat_banner').prop("required", true);
          }

      });
  </script>
