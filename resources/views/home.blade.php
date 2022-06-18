@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 mt-4">
      <div class="card">
          <div class="card-header text-gray">
            <div class="d-flex align-items-center">
              <h2><i class="fas fa-flag-checkered" aria-hidden="true"></i> Races</h2>
            </div>
        </div>
          <div class="card-body text-secondary">
      <table class="table table-striped table-font">
        <thead>
          <tr>
            <th scope="col">Date</th>
            <th scope="col">Name</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($races as $race)
          <tr>
            <td class="align-middle">{{ $race->racedate }}</td>
            <td class="align-middle"><a href="/admin/races/{{ $race->id }}">{{ $race->name }}</a></td>
            <td class="align-middle">
              @if (raceComplete($race->id) && picksEntered($race->id, Auth::id()))
                <a href="picks/{{ $race->id }}" class="btn btn-md btn-block btn-success">View Results</a>
              @elseif (raceComplete($race->id) && ! picksEntered($race->id, Auth::id()))
                <a href="#" class="btn btn-md btn-block btn-danger">Picks Missing</a>
              @elseif (! raceStarted($race->id) && picksEntered($race->id, Auth::id()))
                  <a href="picks/{{ $race->id }}/edit" class="btn btn-md btn-block btn-info">Edit Picks</a>
              @elseif (! raceStarted($race->id) && ! picksEntered($race->id, Auth::id()))
                  <a href="picks/create/{{ $race->id }}" class="btn btn-md btn-block btn-primary">Enter Picks</a>
              @endif

            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="col-md-4 mt-4">
    <div class="card">
        <div class="card-header text-gray">
          <div class="d-flex align-items-center">
            <h2><i class="fa fa-user" aria-hidden="true"></i> Standings</h2>
          </div>
      </div>
        <div class="card-body text-secondary">
    <table class="table table-striped table-font">
      <thead>
        <tr>
          <th scope="col">Player</th>
          <th scope="col">Points</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($standings as $standing)
        <tr>
          <td class="align-middle">{{ $standing['name'] }}</td>
          <td class="align-middle">{{ $standing['points'] }}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>
  </div>
</div>
  </div>
</div>
@endsection
