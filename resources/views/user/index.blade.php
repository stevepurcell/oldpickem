@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12 mt-4">
      <div class="card">
          <div class="card-header text-gray">
            <div class="d-flex align-items-center">
              <h2><i class="fa fa-users" aria-hidden="true"></i> Players</h2>
            </div>
        </div>
          <div class="card-body text-secondary">
      <table class="table table-striped table-font">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Added</th>
            <th scope="col">Modified</th>
            <th scope="col">Role</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
          <tr>
            <td class="align-middle">{{ $user->id }}</td>
            <td class="align-middle">{{ $user->name }}</td>
            <td class="align-middle">{{ $user->created_at->diffForHumans() }}</td>
            <td class="align-middle">{{ $user->updated_at->diffForHumans() }}</td>
            <td class="align-middle">
					@if(getAdminStatus($user->id) == 1)
                <span class="badge badge-warning">Admin</span>
              @else 
                <span class="badge badge-primary">Player</span>
              @endif
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