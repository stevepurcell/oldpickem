@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-12 mt-4">
          <div class="card">
              <div class="card-header text-gray">
                  <div class="d-flex align-items-center">
                      <h2>Create Race</h2>
                        <div class="ml-auto">
                            <a href="/admin/races" class="btn btn-lg btn-outline-dark">Back</a>
                        </div>
                  </div>
              </div>
              <div class="card-body text-secondary">
      <form action="{{ route('races.store') }}" method="post">
        <div class="form-group">
          <label for="racedate"><h3>Race Date:</h3></label>
          <input type="text" class="form-control form-control-lg" name="racedate" placeholder="YYYY-MM-DD">
        </div>
              <div class="form-group">
                <label for="name"><h3>Name:</h3></label>
                <input type="text" class="form-control form-control-lg" name="name">
              </div>
            	<div class="form-group">
                <label for="country">Track</label>
                <select class="form-control form-control-lg" name="track_id">
                  <option value = "">Choose a Track</option>
                  @foreach($tracks as $track)
                    <option value = "{{ $track->id }}"> {{$track->name}}</option>
                  @endforeach
                </select>
              </div>
               <div>
                  <button class="btn btn-primary btn-lg" type="submit" >Save Race</button>
               </div>
               {{ csrf_field() }}
           </form>
       </div>
@endsection