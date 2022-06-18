@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-12 mt-4">
          <div class="card">
              <div class="card-header text-gray">
                  <div class="d-flex align-items-center">
                      <h2>Create Driver</h2>
                        <div class="ml-auto">
                            <a href="/admin/countries/create" class="btn btn-lg btn-outline-dark">Add Country</a>
                            <a href="/admin/constructors" class="btn btn-lg btn-outline-dark">Back</a>
                        </div>
                  </div>
              </div>
              <div class="card-body text-secondary">
      <form action="{{ route('drivers.store') }}" method="post">
        <div class="form-group row">
          <label for="abbr"class="col-sm-2 col-form-label"><h3>Abbreviation:</h3></label>
          <div class="col-sm-10">
            <input type="text" class="form-control form-control-lg" name="abbr">
          </div>
        </div>
        <div class="form-group row">
            <label for="name"class="col-sm-2 col-form-label"><h3>Name:</h3></label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-lg" name="name">
            </div>
          </div>
        <div class="form-group row">
          <label for="country" class="col-sm-2 col-form-label"><h3>Country</h3></label>
          <div class="col-sm-10">
            <select class="form-control form-control-lg" name="country_id">
              <option value = "">Choose a Country</option>
                @foreach($countries as $country)
                  <option value = "{{ $country->id }}"> {{$country->name}}</option>
                @endforeach
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="constructor" class="col-sm-2 col-form-label"><h3>Constructor</h3></label>
          <div class="col-sm-10">
            <select class="form-control form-control-lg" name="constructor_id">
              <option value = "">Choose a Constructor</option>
                @foreach($constructors as $constructor)
                  <option value = "{{ $constructor->id }}"> {{$constructor->name}}</option>
                @endforeach
            </select>
          </div>
        </div>
              <div class="form-group row">
                <label for="carnumber" class="col-sm-2 col-form-label"><h3>Car Number:</h3></label>
                <div class="col-sm-10">
                <input type="text" class="form-control form-control-lg" name="carnumber">
              </div>
            </div>
              <div class="form-group row">
                <label for="birthyear" class="col-sm-2 col-form-label"><h3>Birth Year:</h3></label>
                <div class="col-sm-10">
                  <input type="text" class="form-control form-control-lg" name="birthyear">
                </div>
              </div>
              <div class="form-group row">
                <label for="driver_img" class="col-sm-2 col-form-label"><h3>Driver Image:</h3></label>
                <div class="col-sm-10">
                  <input type="text" class="form-control form-control-lg" name="driver_img">
                </div>
              </div>
               <div>
                  <button class="btn btn-primary btn-lg" type="submit" >Save Driver</button>
               </div>
               {{ csrf_field() }}
           </form>
       </div>
@endsection
