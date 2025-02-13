@extends('layouts.dashboard')

@section('title')
Categories
@endsection

@section('description')
List of all Categories on your website.
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
        <form class="row g-1" method="GET" action="{{ route('categories.index') }}">
            <div class="col-auto">
                <input type="text" name="query" class="form-control" value="{{ request('query') }}"
                    placeholder="Search">
            </div>
            <div class="col-auto">
                <select class="form-select" name="type">
                    <option value="all">All Types</option>
                    <option value="news" {{ request('type')=='news' ? 'selected' : '' }}>News
                    </option>
                    <option value="project" {{ request('type')=='project' ? 'selected' : '' }}>Project
                    </option>
                    <option value="faq" {{ request('type')=='faq' ? 'selected' : '' }}>FAQ</option>
                </select>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>
    </div>
    <a href="{{ route('categories.create') }}" class="mr-2 btn btn-primary">
        <i class="align-middle" data-feather="plus"></i>
        Add
    </a>
</div>
<div class="card flex-fill mt-3">
    <table class="table my-0 table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Type</th>
                <th>Date Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; ?>
            @forelse ($categories as $category)
            <tr>
                <td>
                    {{ $no++ }}
                </td>
                <td>
                    {{ $category->title }}
                </td>
                <td>
                    {{ $category->slug }}
                </td>
                <td>
                    @if ($category->type == 'project')
                    <span class="badge bg-success">{{ $category->type }}</span>
                    @elseif ($category->type == 'news')
                    <span class="badge bg-primary">{{ $category->type }}</span>
                    @else
                    <span class="badge bg-warning">{{ $category->type }}</span>
                    @endif
                </td>
                <td>
                    {{ $category->created_at->format('M d, Y') }}</td>
                </td>
                <td>
                    <a href="{{ route('categories.edit', ['category' => $category->slug]) }}"
                        class="btn btn-sm btn-primary"><i class="align-middle" data-feather="edit-2"></i>
                        <span class="align-middle"> Edit</a>
                    <form action="{{ route('categories.destroy', ['category' => $category->slug]) }}" method="post"
                        class="d-inline">
                        @method('delete')
                        @csrf
                        <button title="Delete" class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure want to delete this {{ $category->title }}? You will lose related data (news, projects, etc.)')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">No Categories Found...</td>
            </tr>
            @endforelse


        </tbody>
    </table>
</div>
<div class="pagination-area mt-3">
    {{ $categories->links('vendor.pagination.bootstrap-5') }}
</div>
@endsection
