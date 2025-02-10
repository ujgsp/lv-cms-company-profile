@extends('layouts.dashboard')

@section('title')
Sliders
@endsection

@section('description')
List of all Sliders on your website.
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
        <form class="row g-1" method="GET" action="{{ route('sliders.index') }}">
            <div class="col-auto">
                <input type="text" name="query" class="form-control" value="{{ request('query') }}"
                    placeholder="Search">
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>
    </div>
    <a href="{{ route('sliders.create') }}" class="mr-2 btn btn-primary">
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
                    <th>Button Title</th>
                    <th>Button Link</th>
                    <th>Default Status</th>
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sliders as $slider)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="thumbnail-wrapper">
                                @if ($slider->thumbnail)
                                <img src="{{ asset('storage/' . $slider->thumbnail) }}" class="img-fluid rounded"
                                    alt="{{ $slider->text_primary }}">
                                @else
                                <img src="{{ asset('static/images/slider-main/bg2.jpg') }}" class="img-fluid rounded"
                                    alt="{{ $slider->text_primary }}">
                                @endif
                            </div>
                            <div class="ms-3">
                                <div><strong>{{ Str::limit($slider->text_primary, 100) }}</strong></div>
                                <div class="text-muted d-none d-xxl-table-cell text-break text-wrap text-truncate"
                                    style="max-width: 42.5rem;">
                                    {{ $slider->text_secondary }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $slider->btn_title }}</td>
                    <td>{{ $slider->btn_link }}</td>
                    <td>
                        <div class="form-check form-switch form-switch-sm">
                            <input class="form-check-input is-featured-checkbox" type="checkbox"
                                data-id="{{ $slider->id }}" {{ $slider->status === 'enable' ? 'checked' : '' }}>
                        </div>
                    </td>

                    <td>
                        {{ $slider->created_at->format('M d, Y') }}</td>
                    </td>
                    <td>
                        <a href="{{ route('sliders.edit', $slider) }}" class="btn btn-sm btn-primary">
                            <i class="align-middle" data-feather="edit-2"></i>
                            <span class="align-middle"> Edit </span>
                        </a>
                        <form action="{{ route('sliders.destroy', $slider) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button title="Delete" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure want to delete this {{ $slider->text_primary }} ?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">No sliders Found...</td>
                </tr>
                @endforelse


            </tbody>
        </table>
    </div>
</div>
<div class="pagination-area mt-3">
    {{ $sliders->links('vendor.pagination.bootstrap-5') }}
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
@push('js')
<script>
   $(document).ready(function() {
    $('.is-featured-checkbox').on('change', function() {
        var isChecked = $(this).is(':checked');
        var sliderId = $(this).data('id');
        var token = '{{ csrf_token() }}';

        $.ajax({
            url: '{{ route("sliders.toggleFeatured") }}',
            method: 'POST',
            data: {
                _token: token,
                id: sliderId,
                status: isChecked ? 'enable' : 'disable' // pastikan status sesuai
            },
            success: function(response) {
                console.log('Is Featured status updated successfully!');
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                alert('An error occurred while updating the status.');
            }
        });
    });
});

</script>

@endpush
