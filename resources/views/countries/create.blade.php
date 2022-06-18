@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-12 mt-4">
          <div class="card">
              <div class="card-header text-gray">
                  <div class="d-flex align-items-center">
                      <h2>Create Country</h2>
                        <div class="ml-auto">
                            <a href="/admin/countries" class="btn btn-lg btn-outline-dark">Back</a>
                        </div>
                  </div>
              </div>
              <div class="card-body text-secondary">
			<form action="{{ route('countries.store') }}" method="post">
              <div class="form-group">
                <label for="name"><h3>Name:</h3></label>
                <input type="text" class="form-control form-control-lg" name="name">
              </div>
            	<div class="form-group">
                <label for="flag"><h3>Flag Abbreviation:</h3></label>
                <input type="text" class="form-control form-control-lg" name="flag">
              </div>
                <div class="form-group col-md-4">
                  <strong>Date : </strong>
                  <input class="date form-control"  type="text" id="datepicker" name="date">
               </div>
               <div>
                  <button class="btn btn-primary btn-lg" type="submit" >Create Country</button>
               </div>
               {{ csrf_field() }}
           </form>
       </div>
       <script type="text/javascript">
        $('#datepicker').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
         });
    </script>
@endsection