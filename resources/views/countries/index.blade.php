@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12 mt-4">
      <div class="card">
          <div class="card-header text-gray">
            <div class="d-flex align-items-center">
                <h2><i class="fa fa-map-pin" aria-hidden="true"></i> Countries</h2>
                  <div class="ml-auto">
                      <a href="/admin/countries/create" class="btn btn-lg btn-outline-dark">Add Country</a>
                      <a href="/countries/trash" class="btn btn-lg btn-outline-dark">
                        <i class="fa fa-trash-alt"></i>&nbsp;Trash</a>
                  </div>
            </div>
        </div>
          <div class="card-body text-secondary">
      <table class="table table-striped" style="font-size:125%">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Flag</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
            <th scope="col" colspan="2">Actions</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($countries as $country)
          <tr>
            <td class="align-middle"><a href="/admin/countries/{{ $country->id }}">{{ $country->name }}</a></td>
            <td class="align-middle"><span class="flag-icon flag-icon-{{ $country->flag }}" style="font-size: 150%"></span></td>
            <td class="align-middle">{{ $country->created_at->diffForHumans()  }}</td>
            <td class="align-middle">{{ $country->updated_at->diffForHumans()  }}</td>
            <td class="align-middle" width="5px">
              <a href="countries/{{ $country->id }}/edit" class="btn btn-lg btn-primary">Edit</a>
        </td>
        <td class="align-middle" width="5px">
          <form method="post" action="{{ route('countries.delete', $country->id) }}">
            {{ method_field('delete') }}
            <button type="submit" class="btn btn-lg btn-danger pull-left">Delete</button>
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