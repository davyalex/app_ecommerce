@php
    $msg_validation =' Champs obligatoire';
@endphp
<!-- Modal with form -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">New delivery</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('delivery.store')}}" class="needs-validation" novalidate="" method="post" enctype="multipart/form-data">
                      @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Zone</label>
                            <div class="col-sm-9">
                                <input type="text" name="zone" class="form-control" required="">
                                <div class="invalid-feedback">
                                   {{$msg_validation}}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tarif</label>
                            <div class="col-sm-9">
                                <input type="number" name="tarif" class="form-control" required="">
                                <div class="invalid-feedback">
                                   {{$msg_validation}}
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


