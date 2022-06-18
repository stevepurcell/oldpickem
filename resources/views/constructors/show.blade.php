@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-12 mt-4">
          <div class="card">
              <div class="card-header text-gray">
                    <div class="d-flex align-items-center">
                        <h2>{{ $constructor->name }}</h2>
                    </div>
              </div>
    <div class="card-body text-secondary">
        <table>
            <tbody>
                <tr>
                    <td class="font-weight-bold h3 w-25" rowspan="0"><img src="{{ asset('/images/constructors/') }}/{{  $constructor->constructor_img }}" style="width: 450px; height: 133px;"></td>
                </tr>
                <tr>
                    <td><h2>Country:</h2></td>
                    <td><h2>{{  $constructor->country->name }}</h2></td>
                </tr>
                <tr>
                    <td><h2>Manufacturer:</h2></td>
                    <td><h2>{{  $constructor->manufacturer }}</h2></td>
                </tr>
                <tr>
                    <td><h2>Chassis:</h2></td>
                    <td><h2>{{  $constructor->chassis }}</h2></td>
                </tr>                                                    
                <tr>
                    <td><h2>Power Unit:</h2></td>
                    <td><h2>{{  $constructor->powerunit }}</h2></td>
                </tr>                                                    
                <tr>
                    <td colspan="2"><h2>Drivers:</h2></td>
                </tr>
                <tr>
                        @foreach($constructor->driver as $driver)
                            <tr>
                                <td></td>
                                <td><h2><a href="{{ route('drivers.show', $driver->id) }}">{{ $driver->name }}</a></h2></td>
                            </tr>
                        @endforeach
            </tbody>
        </table>
        <hr>
            <div class="row ml-1 mt-1">
                <a href="{{ route('constructors.edit', $constructor->id) }}" class="btn btn-lg btn-success mr-1">Edit</a>
                <a href="/admin/constructors" class="btn btn-lg btn-primary mr-1">Back</a>
            </div>

    </div>
  </div>
</div>
@endsection