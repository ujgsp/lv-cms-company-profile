@extends('layouts.dashboard')

@section('title')
    Testimonials
@endsection

@section('description')
    List of all Testimonials on your website.
@endsection

@section('content')
    @if (session()->has('success'))
        <div class="mt-3 alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
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
            <form class="row g-1" method="GET" action="{{ route('testimonials.index') }}">
                <div class="col-auto">
                    <input type="text" name="query" class="form-control" value="{{ request('query') }}"
                        placeholder="Search">
                </div>
                <div class="col-auto">
                    <select class="form-select" name="status">
                        <option value="all">All Status</option>
                        <option value="enable" {{ request('status') == 'enable' ? 'selected' : '' }}>Enable</option>
                        <option value="disable" {{ request('status') == 'disable' ? 'selected' : '' }}>Disable</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
        <a href="{{ route('testimonials.create') }}" class="mr-2 btn btn-primary">
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
                        <th>Status</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($testimonials as $testimonial)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="thumbnail-wrapper">
                                        @if ($testimonial->image)
                                            <img src="{{ asset('storage/' . $testimonial->image) }}"
                                                class="img-fluid rounded" alt="{{ $testimonial->name }}">
                                        @else
                                            <img src="{{ asset('static/images/team/default_user_2_optimize.png') }}"
                                                class="img-fluid rounded" alt="{{ $testimonial->name }}">
                                        @endif

                                    </div>
                                    <div class="ms-3">
                                        <div><strong>{{ Str::limit($testimonial->name, 100) }}</strong></div>
                                        <small class="text-muted">{{ $testimonial->designation }}
                                            {{ $testimonial->organization ? '- ' . $testimonial->organization : '' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if ($testimonial->status === 'enable')
                                    <span class="badge bg-success">{{ $testimonial->status }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ $testimonial->status }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $testimonial->created_at->format('M d, Y') }}</td>
                            </td>
                            <td>
                                <a href="{{ route('testimonials.edit', $testimonial) }}" class="btn btn-sm btn-primary">
                                    <i class="align-middle" data-feather="edit-2"></i>
                                    <span class="align-middle"> Edit </span></a>
                                <form action="{{ route('testimonials.destroy', $testimonial) }}" method="post"
                                    class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button title="Delete" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure want to delete this {{ $testimonial->title }} ?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No testimonials Found...</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
    <div class="pagination-area mt-3">
        {{ $testimonials->links('vendor.pagination.bootstrap-5') }}
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
