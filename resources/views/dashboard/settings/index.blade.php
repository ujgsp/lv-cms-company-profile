@extends('layouts.dashboard')

@section('title')
Settings
@endsection

@section('description')
Configure All Settings for Your Website
@endsection

@section('content')

@if (session()->has('success'))
<div class="mt-3 alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($errors->any())
<div class="mt-3 alert alert-danger alert-dismissible" role="alert">
    <div class="alert-message">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<div class="row mt-3">
    <div class="col-md-4 col-xl-3">
        @include('dashboard.settings._partials.sidebar')
    </div>
    <div class="col-md-8 col-xl-9">
        @yield('content_settings')
    </div>
</div>
@endsection
