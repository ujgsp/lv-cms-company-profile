@extends('layouts.dashboard')

@section('title')
Pages
@endsection

@section('description')
List of all Pages on your website.
@endsection

@section('content')
@if (session()->has('success'))
<div class="mt-3 alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($errors->any())
<div class="row mt-3">
    <div class="col-md-12">
        <div class="alert alert-danger alert-dismissible" role="alert">
            <div class="alert-message">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endif

<div class="row">
    <div class="col-12">
        <div class="tld-search-area">
            <div class="input-group tld-search-sec">
                <form class="row g-1" method="GET" action="{{ route('pages.index') }}">
                    <div class="col-auto">
                        <input type="text" name="query" class="form-control" value="{{ request('query') }}"
                            placeholder="Search">
                    </div>
                    <div class="col-auto">
                        <select class="form-select" name="location">
                            <option value="all">All</option>
                            <option value="header" {{ request('location')=='header' ? 'selected' : '' }}>Header
                            </option>
                            <option value="footer" {{ request('location')=='footer' ? 'selected' : '' }}>Footer
                            </option>
                            <option value="both" {{ request('location')=='both' ? 'selected' : '' }}>Both</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
            </div>
            <a href="{{ route('pages.create') }}" class="mr-2 btn btn-primary">
                <i class="align-middle" data-feather="plus"></i> Add Page
            </a>
        </div>
        <div class="card flex-fill mt-3">
            <table class="table table-hover my-0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th class="d-none d-xl-table-cell">Slug</th>
                        <th class="d-none d-xl-table-cell">Location</th>
                        <th>Status</th>
                        <th class="d-none d-md-table-cell">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ( $pages as $page )
                    <tr>
                        <td>{{ $page->title }}</td>
                        <td class="d-none d-xl-table-cell">{{ $page->slug }}</td>
                        <td class="d-none d-xl-table-cell">{{ $page->location }}</td>
                        <td>
                            @if ($page->status == 'publish')
                            <span class="badge bg-success">{{ $page->status }}</span>
                            @else
                            <span class="badge bg-secondary">{{ $page->status }}</span>
                            @endif
                        </td>
                        <td class="d-none d-md-table-cell">
                            <a href="{{ route('pages.edit', ['page' => $page->slug]) }}"
                                class="btn btn-sm btn-primary"><i class="align-middle" data-feather="edit-2"></i> <span
                                    class="align-middle"> Edit</a>
                            <form action="{{ route('pages.destroy', ['page' => $page->slug]) }}" method="post"
                                class="d-inline">
                                @method('delete')
                                @csrf
                                <button title="Delete" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">No Pages Found...</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <!-- Area pagination -->
        <div class="pagination-area mt-3">
            {{ $pages->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
