@extends('layouts.auth')

@section('title')
    Login
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="m-sm-3">
                {{-- <div class="mt-3 alert alert-success alert-dismissible fade show" role="alert">
                    Logged out successfully.        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div> --}}
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input class="form-control form-control-lg @error('email') is-invalid @enderror" type="email"
                            placeholder="Enter your email" name="email" value="{{ old('email') }}" required
                            autocomplete="email" autofocus />

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input class="form-control form-control-lg @error('password') is-invalid @enderror" type="password"
                            name="password" required autocomplete="current-password" placeholder="Enter your password" />

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    @if ($opt_api['status'] == 'enable')
                        {{-- reCAPTCHA --}}
                        <div class="mb-3">
                            <div class="g-recaptcha" data-sitekey="{{ $opt_api['site_key'] }}"></div>

                            @error('g-recaptcha-response')
                                <span class="invalid-feedback" role="alert" style="display: block;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    @endif

                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-lg btn-primary">Login</button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Load reCAPTCHA script --}}
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection
