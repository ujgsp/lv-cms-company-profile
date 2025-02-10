@extends('layouts.auth')
@section('title', 'Reset Password')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="m-sm-3">

                <p class="lead text-center">
                    {{ __('Reset Password') }}
                </p>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input class="form-control form-control-lg @error('email') is-invalid @enderror" type="email"
                            placeholder="Enter your email" name="email" value="{{ old('email') }}" autocomplete="email"
                            required autofocus />

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-lg btn-primary">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
