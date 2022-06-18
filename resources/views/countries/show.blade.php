@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-12 mt-4">
          <div class="card">
              <div class="card-header text-gray">
                  <div class="d-flex align-items-center">
                      <h2>{{ $country->name }}</h2>
                        <div class="ml-auto">
                            <a href="/admin/countries" class="btn btn-lg btn-outline-dark">Back</a>
                        </div>
                  </div>
              </div>
    <div class="card-body text-secondary">
        <h2>Abbreviation: {{ $country->flag }}</h2>
        <h2>Flag: <span class="flag-icon flag-icon-{{ $country->flag }}"></span></h2>
    </div>
  </div>
</div>
@endsection