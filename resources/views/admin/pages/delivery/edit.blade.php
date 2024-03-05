@extends('admin.layouts.app')

@section('content')
    <section class="section">
        @php
            $msg_validation = 'Champs obligatoire';
        @endphp
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-8 m-auto">
                    @include('admin.components.validationMessage')
                    <div class="card">
                        <form action="{{ route('delivery.update', $delivery['id']) }}" class="needs-validation" novalidate=""
                            method="post">
                            @csrf
                            <div class="card-body">
                        @if (request('deli') == 'region')
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ request('deli') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" value="{{$delivery['region']}}" name="region" class="form-control" required="">
                                    <div class="invalid-feedback">
                                        {{ $msg_validation }}
                                    </div>
                                </div>
                            </div>
                        @elseif (request('deli') == 'ville-commune')
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Region</label>
                                <div class="col-sm-9">
                                    <select name="region_id" id="" class="form-control">
                                        <option disabled selected value> Choisir une region</option>
                                        @foreach ($regions as $r)
                                            <option value="{{$r->id}}" {{$r['id'] == $delivery['region_id'] ? 'selected' : ''}}> {{$r->region}} </option>
                                        @endforeach
                                    </select>
                                    {{-- <div class="invalid-feedback">
                                        {{ $msg_validation }}
                                    </div> --}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ville ou commune</label>
                                <div class="col-sm-9">
                                    <input type="text" value="{{$delivery['zone']}}" name="zone" class="form-control" required="">
                                    <div class="invalid-feedback">
                                        {{ $msg_validation }}
                                    </div>
                                </div>
                            </div>
                        @endif





                        {{-- <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tarif</label>
                            <div class="col-sm-9">
                                <input type="number" name="tarif" class="form-control" required="">
                                <div class="invalid-feedback">
                                   {{$msg_validation}}
                                </div>
                            </div>
                        </div> --}}

                    </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Valider</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection
