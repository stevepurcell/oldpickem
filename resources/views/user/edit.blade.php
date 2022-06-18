@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-gray">
            <div class="d-flex align-items-center">
              <h2><i class="fa fa-users" aria-hidden="true"></i> Players</h2>
            </div>
        </div>

                <div class="card-body text-secondary">
                    <form method="POST" action="{{ route('user.update') }}">
                        @csrf
                    <div class="form-group">
                        <label for="name"><h3>Name:</h3></label>

                        <input type="text" id="name" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}"    autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email"><h3>Email:</h3></label>

                        <input type="text" id="email" value="{{ $user->email }}"  class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                        <div>
                            <button class="btn btn-success btn-lg" type="submit" >Update Profile</button>
                            <a href="/home" class="btn btn-lg btn-primary">Back</a>
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
