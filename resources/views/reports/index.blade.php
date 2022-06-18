@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-4 mt-4">
      <div class="card">
          <div class="card-header text-gray">
            <div class="d-flex align-items-center">
              <h2><i class="fas fa-users" aria-hidden="true"></i> Drivers</h2>
            </div>
        </div>
          <div class="card-body text-secondary">
      <table class="table table-striped table-font">
        <thead>
          <tr>
            <th scope="col">Driver</th>
            <th scope="col">Points</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($drivers as $driver)
          <tr>
            <td class="align-middle"><a href="/reports/driver/{{ $driver['id'] }}">{{ $driver['name'] }}</a></td>
            <td class="align-middle">{{ $driver['points'] }}</a></td>
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
            <h2><i class="fa fa-cogs" aria-hidden="true"></i> Constructors</h2>
          </div>
      </div>
        <div class="card-body text-secondary">
    <table class="table table-striped table-font">
      <thead>
        <tr>
          <th scope="col">Constructor</th>
          <th scope="col">Points</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($constructors as $constructor)
        <tr>
          <td class="align-middle"><a href="/reports/constructor/{{ $constructor['id'] }}">{{ $constructor['name'] }}</a></td>
            <td class="align-middle">{{ $constructor['points'] }}</a></td>
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
            <h2><i class="fa fa-cogs" aria-hidden="true"></i> Players</h2>
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
      @foreach ($players as $player)
        <tr>
          <td class="align-middle"><a href="/reports/player/{{ $player['id'] }}">
              {{ $player['name'] }}</a></td>
          <td class="align-middle">{{ $player['points'] }}</td>
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
