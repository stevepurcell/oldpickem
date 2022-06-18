@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-12 mt-4">
          <div class="card">
              <div class="card-header text-gray">
                  <div class="d-flex align-items-center">
                      <h2>{{ $track->name }}</h2>
                        <div class="ml-auto">
                            <a href="/admin/countries" class="btn btn-lg btn-outline-dark">Back</a>
                        </div>
                  </div>
              </div>
    <div class="card-body text-secondary">
        <h2>Country:  {{ $track->country->name }}  <span class="flag-icon flag-icon-{{ $track->country->flag }}"></span></h2>
    </div>
  </div>
</div>
@endsection