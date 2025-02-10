@extends('layouts.auth')
@section('title', 'Reset Password')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="m-sm-3">

            <p class="lead text-center">
                {{ __('Reset Password') }}
            </p>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="mb-3">
                    <label class="form-label">{{ __('Email Address') }}</label>
                    <input class="form-control form-control-lg @error('email') is-invalid @enderror" type="email"
                        placeholder="Enter your email" name="email" value="{{ old('email') }}" autocomplete="email"
                        required autofocus />

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Password') }}</label>

                        <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" placeholder="Enter your password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" placeholder="Enter your confirm password" required autocomplete="new-password">

                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="d-grid gap-2 mt-3">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
