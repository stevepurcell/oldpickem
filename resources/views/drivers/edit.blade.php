@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-12 mt-4">
          <div class="card">
              <div class="card-header text-gray">
                  <div class="d-flex align-items-center">
                      <h2>Edit {{ $driver->name }}</h2>
                        <div class="ml-auto">
                            <a href="/admin/tracks" class="btn btn-lg btn-outline-dark">Back</a>
                        </div>
                  </div>
              </div>
              <div class="card-body text-secondary">
                <form action="{{ route('drivers.update', $driver->id) }}" method="post">
                  {{ method_field('patch') }}
              <div class="form-group">
                <label for="abbr"><h3>Abbreviation:</h3></label>
                <input type="text" class="form-control form-control-lg" name="abbr" value="{{ $driver->abbr }}">
              </div>
              <div class="form-group">
                <label for="name"><h3>Name:</h3></label>
                <input type="text" class="form-control form-control-lg" name="name" value="{{ $driver->name }}">
              </div>
              <div class="form-group">
                <label for="constructor">Constructor</label>
                <select class="form-control form-control-lg" name="constructor_id">
                  <option value = "">Choose a Constructor</option>
                  @foreach($constructors as $constructor)
                    <option value = "{{ $constructor->id }}" {{ $driver->constructor_id == $constructor->id ? 'selected="selected"' : '' }}> {{$constructor->name}}</option>
                  @endforeach
                </select>
                </div>
            	<div class="form-group">
                <label for="country">Country</label>
                <select class="form-control form-control-lg" name="country_id">
                  <option value = "">Choose a Country</option>
                  @foreach($countries as $country)
                    <option value = "{{ $country->id }}" {{ $driver->country_id == $country->id ? 'selected="selected"' : '' }}> {{$country->name}}</option>
                  @endforeach
                </select>
                </div>
               <div>
                  <button class="btn btn-primary btn-lg" type="submit" >Update Driver</button>
               </div>
               {{ csrf_field() }}
           </form>
       </div>
@endsection
