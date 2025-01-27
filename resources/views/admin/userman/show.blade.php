@extends('layout.index')
@section('content')
    <div class="container">
        <h3>Password Reset - {{ $user->name }}, {{ $user->email }}</h3>
        @if (session('success'))
            <div class="mt-4">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        <form action="{{ route('userman.show', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row mt-3">
                <div class="form-group col-lg-4 col-md-auto">
                    <label for="password">New Password:</label>
                    <input type="text" id="password" name="password" class="form-control" value="{{ $passwordReset }}"
                        readonly>
                </div>
                <div class="form-group col-lg-4 col-md-auto">
                    <label for="password_confirmation">Confirm Password:</label>
                    <input type="text" id="password_confirmation" name="password_confirmation" class="form-control"
                        value="{{ $passwordReset }}" readonly>
                </div>
                <div class="col-md-12 mt-3">
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                    <a href="{{ route('userman.index') }}" class="btn btn-secondary">Cancel</a>

                </div>
            </div>
        </form>
    </div>
@endsection
