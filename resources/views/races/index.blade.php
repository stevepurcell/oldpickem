@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12 mt-4">
      <div class="card">
          <div class="card-header text-gray">
            <div class="d-flex align-items-center">
                <h2><i class="fa fa-flag-checkered" aria-hidden="true"></i> Races</h2>
                  <div class="ml-auto">
                      <a href="/admin/races/create" class="btn btn-lg btn-outline-dark">Add Race</a>
                      <a href="/admin/tracks/create" class="btn btn-lg btn-outline-dark">Add Track</a>
                      <a href="/races/trash" class="btn btn-lg btn-outline-dark">
                        <i class="fa fa-trash-alt"></i>&nbsp;Trash</a>
                  </div>
            </div>
        </div>
          <div class="card-body text-secondary">
      <table class="table table-striped table-font">
        <thead>
          <tr>
            <th scope="col">Date</th>
            <th scope="col">Name</th>
            <th scope="col">Track</th>
            <th scope="col" colspan="2">Actions</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($races as $race)
          <tr>
            <td class="align-middle">{{ $race->racedate }}</a></td>
            <td class="align-middle"><a href="/admin/races/{{ $race->id }}">{{ $race->name }}</a></td>
            <td class="align-middle"><a href="/admin/tracks/{{ $race->track->id }}">{{ $race->track->name }}</a></td>
            <td class="align-middle" width="5px">
              <a href="races/{{ $race->id }}/edit" class="btn btn-lg btn-primary">Edit</a>
        </td>
        <td class="align-middle" width="5px">
          <form method="post" action="{{ route('races.delete', $race->id) }}">
            {{ method_field('delete') }}
            <button type="submit" class="btn btn-danger btn-lg pull-left">Delete</button>
            {{ csrf_field() }}
           </form>
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
