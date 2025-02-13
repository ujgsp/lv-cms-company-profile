@extends('layouts.dashboard')

@section('title')
Members
@endsection

@section('description')
List of all Members on your website.
@endsection

@section('content')
@if (session()->has('success'))
<div class="mt-3 alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('error'))
    <div class="mt-3 alert alert-danger">
        {{ session('error') }}
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
        <form class="row g-1" method="GET" action="{{ route('members.index') }}">
            <div class="col-auto">
                <input type="text" name="query" class="form-control" value="{{ request('query') }}"
                    placeholder="Search">
            </div>
            <div class="col-auto">
                <select class="form-select" name="status">
                    <option value="all">All Status</option>
                    <option value="enable" {{ request('status')=='enable' ? 'selected' : '' }}>Enable</option>
                    <option value="disable" {{ request('status')=='disable' ? 'selected' : '' }}>Disable</option>
                </select>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>
    </div>
    <a href="{{ route('members.create') }}" class="mr-2 btn btn-primary">
        <i class="align-middle" data-feather="plus"></i>
        Add
    </a>
</div>
<div class="card flex-fill mt-3">
    <table class="table my-0 table-hover">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Date Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($members as $member)
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="thumbnail-wrapper">
                            <img src="{{ asset('storage/' . $member->image) }}" class="img-fluid rounded"
                                alt="{{ $member->name }}">
                        </div>
                        <div class="ms-3">
                            <div><strong>{{ Str::limit($member->name, 100) }}</strong></div>
                            <div class="text-muted">{{ $member->designation }}</div>
                        </div>
                    </div>
                </td>
                <td>
                    @if ($member->status === 'enable')
                    <span class="badge bg-success">{{ $member->status }}</span>
                    @else
                    <span class="badge bg-secondary">{{ $member->status }}</span>
                    @endif
                </td>
                <td>
                    {{ $member->created_at->format('M d, Y') }}</td>
                </td>
                <td>
                    <a href="{{ route('members.show', $member) }}" class="btn btn-sm btn-success">
                        <i class="align-middle" data-feather="eye"></i>
                        <span class="align-middle"> Show </span></a>
                    <a href="{{ route('members.edit', $member) }}" class="btn btn-sm btn-primary">
                        <i class="align-middle" data-feather="edit-2"></i>
                        <span class="align-middle"> Edit </span> </a>
                    <form action="{{ route('members.destroy', $member) }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button title="Delete" class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure want to delete this {{ $member->title }} ?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">No Members Found...</td>
            </tr>
            @endforelse


        </tbody>
    </table>
</div>
{{-- <div class="pagination-area mt-3">
    {{ $members->links('vendor.pagination.bootstrap-5') }}
</div> --}}
@endsection

@push('css')
<style>
    .thumbnail-wrapper {
        flex-shrink: 0;
        width: 80px;
        /* Adjust width as needed */
        height: auto;
    }

    .thumbnail-wrapper img {
        width: 100%;
        height: 3.25rem;
        object-fit: cover;
    }

    .table td {
        vertical-align: middle;
    }

    .table .d-flex .text-muted {
        font-size: 0.80rem;
    }

    .d-flex.align-items-center .ms-3 {
        max-width: calc(100% - 80px);
    }

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
</style>
@endpush
