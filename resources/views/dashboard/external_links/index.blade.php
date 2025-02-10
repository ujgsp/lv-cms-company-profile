@extends('layouts.dashboard')

@section('title')
Header / Footer Links
@endsection

@section('description')
List of all Header / Footer Links on your website.
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
        <form class="row g-1" method="GET" action="{{ route('links.index') }}">
            <div class="col-auto">
                <input type="text" name="query" class="form-control" value="{{ request('query') }}"
                    placeholder="Search">
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>
    </div>
    <a href="{{ route('links.create') }}" class="mr-2 btn btn-primary">
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
                    <th>Location URL</th>
                    <th>Placement</th>
                    <th>New Tab</th>
                    <th>Status</th>
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($external_links as $external_link)
                <tr>
                    <td>{{ $external_link->title }}</td>
                    <td class="text-truncate" style="max-width: 150px;">{{ $external_link->location }}</td>
                    <td>{{ $external_link->placement }}</td>
                    <td>{{ $external_link->new_tab == 1 ? 'new tab' : '-' }}</td>
                    <td>
                        <div class="form-check form-switch form-switch-sm">
                            <input class="form-check-input is-featured-checkbox" type="checkbox"
                                data-id="{{ $external_link->id }}" {{ $external_link->status == 'enable' ? 'checked' :
                            '' }}>
                        </div>
                    </td>
                    <td>
                        {{ $external_link->created_at->format('M d, Y') }}</td>
                    </td>
                    <td>
                        <a href="{{ route('links.edit', $external_link) }}" class="btn btn-sm btn-primary">
                            <i class="align-middle" data-feather="edit-2"></i>
                            <span class="align-middle"> Edit</span> </a>
                        <form action="{{ route('links.destroy', $external_link) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button title="Delete" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure want to delete this data?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">No Header / Footer Links Found...</td>
                </tr>
                @endforelse


            </tbody>
        </table>
    </div>
</div>
{{-- <div class="pagination-area mt-3">
    {{ $external_links->links('vendor.pagination.bootstrap-5') }}
</div> --}}
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('.is-featured-checkbox').on('change', function() {
            var isChecked = $(this).is(':checked');
            var sliderId = $(this).data('id');
            var token = '{{ csrf_token() }}';

            $.ajax({
                url: '{{ route("links.toggleStatus") }}',
                method: 'POST',
                data: {
                    _token: token,
                    id: sliderId,
                    status: isChecked ? 'enable' : 'disable'
                },
                success: function(response) {
                    console.log('Is status updated successfully!');
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
