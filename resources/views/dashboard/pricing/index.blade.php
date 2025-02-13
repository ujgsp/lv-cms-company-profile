@extends('layouts.dashboard')

@section('title')
Pricing
@endsection

@section('description')
List of all Pricing on your website.
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
        <form class="row g-1" method="GET" action="{{ route('pricings.index') }}">
            <div class="col-auto">
                <input type="text" name="query" class="form-control" value="{{ request('query') }}"
                    placeholder="Search">
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>
    </div>
    <a href="{{ route('pricings.create') }}" class="mr-2 btn btn-primary">
        <i class="align-middle" data-feather="plus"></i>
        Add
    </a>
</div>
<div class="card flex-fill mt-3">
    <table class="table my-0 table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Is Featured</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @forelse ($pricing as $price)
            <tr>
                <td>
                    {{ $i++; }}
                </td>
                <td>
                    {{ $price->name }}
                </td>
                <td>
                    {{ $price->price }}
                </td>
                <td>
                    {{ $price->duration }}</td>
                </td>
                <td>
                    <div class="form-check form-switch form-switch-sm">
                        <input class="form-check-input is-featured-checkbox" type="checkbox" data-id="{{ $price->id }}"
                            {{ $price->featured ? 'checked' : '' }}>
                    </div>
                </td>
                <td>
                    <a href="{{ route('pricings.edit', $price) }}" class="btn btn-sm btn-primary"><i
                            class="align-middle" data-feather="edit-2"></i>
                        <span class="align-middle"> Edit </span> </a>
                    <form action="{{ route('pricings.destroy', $price) }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button title="Delete" class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure want to delete this: {{ $price->name }} ?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">No pricing Found...</td>
            </tr>
            @endforelse


        </tbody>
    </table>
</div>
{{-- <div class="pagination-area mt-3">
    {{ $pricing->links('vendor.pagination.bootstrap-5') }}
</div> --}}
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('.is-featured-checkbox').on('change', function() {
            var isChecked = $(this).is(':checked');
            var pricingId = $(this).data('id');
            var token = '{{ csrf_token() }}';

            $.ajax({
                url: '{{ route("pricings.toggleFeatured") }}',
                method: 'POST',
                data: {
                    _token: token,
                    id: pricingId,
                    is_featured: isChecked ? 1 : 0
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
