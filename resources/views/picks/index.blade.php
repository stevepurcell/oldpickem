@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12 mt-4">
      <div class="card">
          <div class="card-header text-gray">
            <div class="d-flex align-items-center">
              <h2><i class="fa fa-flag-checkered" aria-hidden="true"></i> 2021 Race Schedule</h2>
            </div>
        </div>
          <div class="card-body text-secondary">
      <table class="table table-striped table-font">
        <thead>
          <tr>
            <th scope="col">Date</th>
            <th scope="col">Name</th>
            <th scope="col">Track</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($races as $race)
          <tr>
            <td class="align-middle">{{ $race->racedate }}</td>
            <td class="align-middle">{{ $race->name }}</td>
            <td class="align-middle">{{ $race->track->name }}</td>
            <td class="align-middle">
            @if (raceStarted($race->id) && picksEntered($race->id, Auth::id()))
                <a href="picks/create/{{ $race->id }}" class="btn btn-lg btn-block btn-success">View Picks</a>
            @elseif (! raceStarted($race->id) && picksEntered($race->id, Auth::id()))
                <a href="picks/{{ $race->id }}/edit" class="btn btn-lg btn-block btn-info">Edit Picks</a>
            @elseif (! raceStarted($race->id) && ! picksEntered($race->id, Auth::id()))
                <a href="picks/create/{{ $race->id }}" class="btn btn-lg btn-block btn-primary">Enter Picks</a>
            @endif

              </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
  </div>
</div>
@endsection
