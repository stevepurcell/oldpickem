@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-12 mt-4">
          <div class="card">
              <div class="card-header text-gray">
                  <div class="d-flex align-items-center">
                      <h2>{{ $race->name }}</h2>
                        <div class="ml-auto">
                            <a href="/admin/races" class="btn btn-lg btn-outline-dark">Back</a>
                        </div>
                  </div>
              </div>
    <div class="card-body text-secondary">
        <table>
            <tr>
                <td><h2>Date:</h2></td>
                <td><h2>{{ $race->racedate }}</h2></td>
            </tr>
            <tr>
                <td><h2>Track:</h2></td>
                <td><h2>{{ $race->track->name }}</h2><td>
            </tr>
            <tr>
                <td><h2>Country:&nbsp;&nbsp;</h2></td>
                <td><h2>{{ $race->track->country->name }}  <span class="flag-icon flag-icon-{{ $race->track->country->flag }}"></span></h2><td>
            </tr>
        </table>

    </div>
  </div>
</div>
@endsection