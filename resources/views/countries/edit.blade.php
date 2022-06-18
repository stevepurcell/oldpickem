@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-12 mt-4">
          <div class="card">
              <div class="card-header text-gray">
                  <div class="d-flex align-items-center">
                      <h2>Edit {{ $country->name }}</h2>
                        <div class="ml-auto">
                            <a href="/admin/countries" class="btn btn-lg btn-outline-dark">Back</a>
                        </div>
                  </div>
              </div>
              <div class="card-body text-secondary">
                <form action="{{ route('countries.update', $country->id) }}" method="post">
                  {{ method_field('patch') }}
              <div class="form-group">
                <label for="name"><h3>Name:</h3></label>
                <input type="text" class="form-control form-control-lg" name="name" value="{{ $country->name }}">
              </div>
            	<div class="form-group">
                <label for="flag"><h3>Flag Abbreviation:</h3></label>
                <input type="text" class="form-control form-control-lg" name="flag" value="{{ $country->flag }}">
              </div>
               <div>
                  <button class="btn btn-primary btn-lg" type="submit" >Update Country</button>
               </div>
               {{ csrf_field() }}
           </form>
       </div>
@endsection