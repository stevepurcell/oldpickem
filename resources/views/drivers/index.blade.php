@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12 mt-4">
      <div class="card">
          <div class="card-header text-gray">
            <div class="d-flex align-items-center">
                <h2><i class="fa fa-user" aria-hidden="true"></i> Drivers</h2>
                  <div class="ml-auto">
                      <a href="/admin/drivers/create" class="btn btn-lg btn-outline-dark">Add Driver</a>
                      <a href="/admin/constructors/create" class="btn btn-lg btn-outline-dark">Add Constructor</a>
                      <a href="/admin/countries/create" class="btn btn-lg btn-outline-dark">Add Country</a>
                      <a href="/drivers/trash" class="btn btn-lg btn-outline-dark">
                        <i class="fa fa-trash-alt"></i>&nbsp;Trash</a>
                  </div>
            </div>
        </div>
          <div class="card-body text-secondary">
      <table class="table table-striped table-font">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Abbr</th>
            <th scope="col">Country</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
            <th scope="col" colspan="2">Actions</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($drivers as $driver)
          <tr>
            <td class="align-middle"><a href="/admin/drivers/{{ $driver->id }}">{{ $driver->name }}</a></td>
            <td class="align-middle">{{ $driver->abbr }}</a></td>
            <td class="align-middle">{{ $driver->country->name }}</a></td>
            <td class="align-middle">{{ $driver->created_at->diffForHumans()  }}</td>
            <td class="align-middle">{{ $driver->updated_at->diffForHumans()  }}</td>
            <td class="align-middle" width="5px">
              <a href="drivers/{{ $driver->id }}/edit" class="btn btn-lg btn-primary">Edit</a>
        </td>
        <td class="align-middle" width="5px">
          <form method="post" action="{{ route('drivers.delete', $driver->id) }}">
            {{ method_field('delete') }}
            <button type="submit" class="btn btn-danger btn-lg pull-left">Delete</button>
            {{ csrf_field() }}
           </form>
        </td>
          </tr>
        @endforeach
        </tbody>
      </table>
      {{ $drivers->links() }}
    </div>
  </div>
</div>
  </div>
</div>
@endsection
