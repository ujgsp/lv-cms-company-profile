@extends('layouts.dashboard')

@section('title')
Counters
@endsection

@section('description')
List of all Counters on your website. (Prefer to use 4 cells)
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

<div class="tld-search-area">
    <div class="input-group tld-search-sec">
        <form class="row g-1" method="GET" action="{{ route('counters.index') }}">
            <div class="col-auto">
                <input type="text" name="query" class="form-control" value="{{ request('query') }}"
                    placeholder="Search">
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>
    </div>
    <a href="{{ route('counters.create') }}" class="mr-2 btn btn-primary">
        <i class="align-middle" data-feather="plus"></i>
        Add
    </a>
</div>
<div class="card flex-fill mt-3">
    <div class="table-responsive">
        <table class="table my-0 table-hover">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Value</th>
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($counters as $counter)
                <tr>
                    <td>{{ $counter->title }}</td>
                    <td>{{ $counter->value }}</td>
                    <td>
                        {{ $counter->created_at->format('M d, Y') }}</td>
                    </td>
                    <td>
                        <a href="{{ route('counters.edit', $counter) }}" class="btn btn-sm btn-primary">
                            <i class="align-middle" data-feather="edit-2"></i>
                            <span class="align-middle"> Edit</span> </a>
                        <form action="{{ route('counters.destroy', $counter) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button title="Delete" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure want to delete this {{ $counter->title }} ?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">No Counters Found...</td>
                </tr>
                @endforelse


            </tbody>
        </table>
    </div>
</div>
<div class="pagination-area mt-3">
    {{ $counters->links('vendor.pagination.bootstrap-5') }}
</div>
@endsection
