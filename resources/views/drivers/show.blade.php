@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-12 mt-4">
          <div class="card">
              <div class="card-header text-gray">
                    <div class="d-flex align-items-center">
                        <h2>{{ $driver->name }}</h2>
                    </div>
              </div>
    <div class="card-body text-secondary">
        <table>
            <tr>
                <td><h2>Country:</h2></td>
                <td><h2>{{ $driver->country->name }}  <span class="flag-icon flag-icon-{{ $driver->country->flag }}"></span></h2><td>
            </tr>
            <tr>
                <td><h2>Constructor:</h2></td>
                <td><h2>{{ $driver->constructor->name }}</h2><td>
            </tr>
            <tr>
                <td><a href="/admin/drivers/{{ $driver->id }}/edit" class="btn btn-lg btn-success">Edit</a>
                    <a href="/admin/drivers" class="btn btn-lg btn-primary">Back</a>
                </td>
                <td></td>
            </tr>
            
        </table>

    </div>
  </div>
</div>
@endsection