@extends('layouts.dashboard')

@section('title')
Dashboard
@endsection

@section('description')
Welcome to the Administration Panel.
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
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Total News</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle" data-feather="file-text"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1">{{ $totalNews }}</h1>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Total Projects</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle" data-feather="link-2"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1">{{ $totalProjects }}</h1>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Total Services</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle" data-feather="layers"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1">{{ $totalServices }}</h1>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Total FAQs</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle" data-feather="help-circle"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1">{{ $totalFaqs }}</h1>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Total Members</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle" data-feather="users"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1">{{ $totalMembers }}</h1>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Total Partners</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle" data-feather="coffee"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1">{{ $totalPartners }}</h1>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Total Emails</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle" data-feather="mail"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1">{{ $totalEmails }}</h1>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Total Subscribers</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle" data-feather="users"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1">{{ $totalSubscribers }}</h1>
            </div>
        </div>
    </div>
</div>

<h1 class="h3 mt-3">
    <span class="ml-2">Website Information</span>
</h1>
<span class="mb-3">Some statistics and information about your website.</span>
<div class="row mt-3">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Install Information</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <i class="align-middle" data-feather="settings"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3"><span style="font-size: 15px; position: relative; bottom: 5px;"
                        class="badge bg-success">1.1.1</span> Konstruxio</h1>
                <div class="mb-0">
                    <span class="text-muted">Developed &amp; Maintained by RelitDev. Thank you for purchasing our
                        product.</span>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="card flex-fill mt-3">
    <table class="table my-0 table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Web Server</th>
                <td>{{ $_SERVER['SERVER_SOFTWARE'] }}</td>
            </tr>
            <tr>
                <th>PHP Version</th>
                <td>{{ phpversion() }}</td>
            </tr>
            <tr>
                <th>Base Website URL</th>
                <td>{{ config('app.url') }}</td>
            </tr>
            <tr>
                <th>Cookie Domain</th>
                <td>{{ config('session.domain') }}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

@push('css')
<style>
    .stat {
        align-items: center;
        background: #d3e2f7;
        border-radius: 50%;
        display: flex;
        height: 40px;
        justify-content: center;
        width: 40px;
    }
</style>
@endpush
