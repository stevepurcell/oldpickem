@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12 mt-4">
      <div class="card">
        <div class="card-header text-gray">
                <div class="d-flex align-items-center">
                    <h2><i class="fa fa-user"></i>   Driver Results - {{ getDriverName($driver_id) }}</h2>
                    <div class="ml-auto">
                            <a href="/reports" class="btn btn-lg btn-outline-secondary">Back</a>
                        </div>
                </div>
        </div>
          <div class="card-body text-secondary">
      <table class="table table-striped table-font">
        <thead>
          <tr style="background-color: #A9A9A9;">
            <th scope="col">Position</th>
            <th scope="col">Driver</th>
            <th scope="col">Finish</th>
            <th scope="col">Points</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($results as $result)
          <tr>
            <td class="align-middle">{{ $result->race_id }}</a></td>
            <td class="align-middle">{{ $result->race->name }}</a></td>
            <td class="align-middle">{{  $result->position }}</td>
            <td class="align-middle">{{ calcPoints($result->position) }}</a></td>
        </td>
          </tr>
        @endforeach
        <tr style="background-color: #A9A9A9;">
            <td></td>
            <td></td>
            <td class="align-right">Total</td>
            <td>{{ returnPoints($driver_id) }}</td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
  </div>
</div>
@endsection
