@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-12 mt-4">
          <div class="card">
              <div class="card-header text-gray">
                  <div class="d-flex align-items-center">
                      <h2>Results - {{ $race->id }}</h2>
                        <div class="ml-auto">
                            <a href="/admin/constructors" class="btn btn-lg btn-outline-dark">Back</a>
                        </div>
                  </div>
              </div>
              <div class="card-body text-secondary">
      <form action="{{ route('results.store') }}" method="post">
        <input type="hidden" id="race_id" name="race_id" value="{{ $race->id }}">
        <div class="form-group row">
            <label for="pos0" class="col-sm-2 col-form-label"><h3>Fastest Lap:</h3></label>
            <div class="col-sm-10">
            <select class="form-control form-control-lg" name="pos0">
                <option value = "">Choose a Driver</option>
                @foreach($drivers as $driver)
                    <option value = "{{ $driver->id }}"> {{$driver->name}}</option>
                @endforeach
            </select>
            </div>
        </div>

        @for ($i = 1; $i <= 20; $i++)
            <div class="form-group row">
                <label for="pos{{ $i }}" class="col-sm-2 col-form-label"><h3>Position {{ $i }}:</h3></label>
                <div class="col-sm-10">
                <select class="form-control form-control-lg" name="pos{{ $i }}">
                    <option value = "">Choose a Driver</option>
                    @foreach($drivers as $driver)
                        <option value = "{{ $driver->id }}"> {{$driver->name}}</option>
                    @endforeach
                </select>
                </div>
            </div>
        @endfor
        
               <div>
                  <button class="btn btn-primary btn-lg" type="submit" >Submit Results</button>
               </div>
               {{ csrf_field() }}
           </form>
       </div>
@endsection