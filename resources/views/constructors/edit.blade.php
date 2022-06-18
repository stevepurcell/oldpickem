@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-12 mt-4">
          <div class="card">
              <div class="card-header text-gray">
                  <div class="d-flex align-items-center">
                      <h2>Edit {{ $constructor->name }}</h2>
                        <div class="ml-auto">
                            <a href="/admin/constructors" class="btn btn-lg btn-outline-dark">Back</a>
                        </div>
                  </div>
              </div>
              <div class="card-body text-secondary">
                <form action="{{ route('constructors.update', $constructor->id) }}" method="post">
                  {{ method_field('patch') }}
              <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label"><h3>Name:</h3></label>
                <div class="col-sm-10">
                  <input type="text" class="form-control form-control-lg" name="name" value="{{ $constructor->name }}">
                </div>
              </div>
            	<div class="form-group row">
                <label for="country" class="col-sm-2 col-form-label"><h3>Country:</h3></label>
                <div class="col-sm-10">
                  <select class="form-control form-control-lg" name="country_id">
                    <option value = "">Choose a Country</option>
                    @foreach($countries as $country)
                      <option value = "{{ $country->id }}" {{ $constructor->country_id == $country->id ? 'selected="selected"' : '' }}> {{$country->name}}</option>
                    @endforeach
                  </select>
                </div>
            	</div>
                <div class="form-group row">
                  <label for="teamchief" class="col-sm-2 col-form-label"><h3>Team Chief:</h3></label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control form-control-lg" name="teamchief" value="{{ $constructor->teamchief }}">
                </div>
              </div>
                <div class="form-group row">
                  <label for="technicalchief" class="col-sm-2 col-form-label"><h3>Tech Chief:</h3></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control form-control-lg" name="technicalchief" value="{{ $constructor->technicalchief }}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="chassis" class="col-sm-2 col-form-label"><h3>Chassis:</h3></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control form-control-lg" name="chassis" value="{{ $constructor->chassis }}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="powerunit" class="col-sm-2 col-form-label"><h3>Powerunit:</h3></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control form-control-lg" name="powerunit" value="{{ $constructor->powerunit }}">
                  </div>
                </div>
               <div>
                  <button class="btn btn-primary btn-lg" type="submit" >Update</button>
               </div>
               {{ csrf_field() }}
           </form>
       </div>
@endsection