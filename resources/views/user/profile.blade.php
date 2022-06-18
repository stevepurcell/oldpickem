

@extends('layouts.app')

@section('content')
<script type="text/javascript">
    document.title = '{{ $user->name }}`s Profile';
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header text-gray">
                    <div class="d-flex align-items-center">
                        <h2>{{ $user->name }}</h2>
                    </div>
                </div>

                <div class="card-body text-secondary p-5">
                    <h2><strong>Email:</strong> {{ $user->email }}</h2>
                    <h2><strong>Role:</strong> {{ getRole($user->id) }}</h2>
                    <a class="btn btn-primary btn-lg" href="{{ route('user.edit') }}">Edit Profile</a>
                    <a class="btn btn-success btn-lg" href="{{ route('password.edit') }}">Change Password</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
