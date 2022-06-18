@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12 mt-4">
      <div class="card">
          <div class="card-header text-gray">
            <div class="d-flex align-items-center">
              <h2><i class="fa fa-user" aria-hidden="true"></i> Race Results</h2>
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
              @if($race->complete == 1)
                <a href="results/{{ $race->id }}" class="btn btn-lg btn-success">View Results</a>
              @else
                <a href="results/{{ $race->id }}/edit" class="btn btn-lg btn-primary">Enter Results</a>
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
