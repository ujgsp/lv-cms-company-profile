@extends('layouts.dashboard')

@section('title')
News Articles
@endsection

@section('description')
List of all News Articles on your website.
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
        <form class="row g-1" method="GET" action="{{ route('news.index') }}">
            <div class="col-auto">
                <input type="text" name="query" class="form-control" value="{{ request('query') }}"
                    placeholder="Search">
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>
    </div>
    <a href="{{ route('news.create') }}" class="mr-2 btn btn-primary">
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
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($news as $n)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="thumbnail-wrapper">
                                <img src="{{ asset('storage/'. $n->thumbnail) }}" class="img-fluid rounded"
                                    alt="{{ $n->title }}">
                            </div>
                            <div class="ms-3">
                                <strong>{{ Str::limit($n->title, 100) }}</strong>
                                {{-- <small class="text-muted d-none d-xxl-table-cell">{{ Str::limit($n->excerpt, 100) }}</small> --}}
                                <div class="text-muted d-none d-xxl-table-cell text-break text-wrap text-truncate" style="max-width: 42.5rem;">
                                    {{ $n->excerpt }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        {{ $n->created_at->format('M d, Y') }}</td>
                    </td>
                    <td class="">
                        <a href="{{ route('news.edit', ['news' => $n->slug]) }}" class="btn btn-sm btn-primary"><i
                                class="align-middle" data-feather="edit-2"></i>
                            <span class="align-middle"> Edit </span> </a>
                        <form action="{{ route('news.destroy', ['news' => $n->slug]) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button title="Delete" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure want to delete this {{ $n->title }} ?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">No News Found...</td>
                </tr>
                @endforelse


            </tbody>
        </table>
    </div>
</div>
<div class="pagination-area mt-3">
    {{ $news->links('vendor.pagination.bootstrap-5') }}
</div>
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
