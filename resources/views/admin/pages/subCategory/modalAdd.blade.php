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

  // ######################
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
</script>


<!-- Modal with form -->
<div class="modal fade" id="modalAddsousCategorie" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="formModal">Ajouter une sous categorie</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form action="{{ route('sub-category.store') }}" class="needs-validation" novalidate="" method="post"
                  enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                      <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nom</label>
                          <div class="col-sm-9">
                              <input type="text" name="name" class="form-control" required="">
                              <div class="invalid-feedback">
                                  Champ obligatoire
                              </div>
                          </div>
                      </div>

                      <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Categorie</label>
                          <div class="col-sm-9">
                              <select name="category" class="form-control selectric " required>
                                  <option disabled selected value>Choisir une categorie</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                              </select>
                              <div class="invalid-feedback">
                                  Champ obligatoire
                              </div>

                          </div>
                      </div>

                      <div class="form-group row">
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
                    </div>


                      <div class="form-group row">
                          <label class="col-sm-3 col-form-label">category image (551 * 551) </label>
                          <div class="col-sm-9">
                              <img id="img-preview"
                                  src="https://ami-sni.com/wp-content/themes/consultix/images/no-image-found-360x250.png"
                                  width="250px" />
                              <input type="file" name="subcat_img" class="form-control" onchange="readURL(this);"
                                  required="">
                              <div class="invalid-feedback">
                                  enter category image
                              </div>
                          </div>
                      </div>

                      <div class="form-group row">
                          <label class="col-sm-3 col-form-label">category banner (1121 * 414) </label>
                          <div class="col-sm-9">
                              <img id="_img-preview"
                                  src="https://ami-sni.com/wp-content/themes/consultix/images/no-image-found-360x250.png"
                                  width="250px" />
                              <input type="file" name="subcat_banner" class="form-control"
                                  onchange="_readURL(this);">
                              {{-- <div class="invalid-feedback">
                                  enter category banner
                              </div> --}}
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
