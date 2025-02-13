@extends('layouts.dashboard')

@section('title')
FAQs
@endsection

@section('description')
List of all FAQs on your website.
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
        <form class="row g-1" method="GET" action="{{ route('faqs.index') }}">
            <div class="col-auto">
                <input type="text" name="query" class="form-control" value="{{ request('query') }}"
                    placeholder="Search">
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>
    </div>
    <a href="{{ route('faqs.create') }}" class="mr-2 btn btn-primary">
        <i class="align-middle" data-feather="plus"></i>
        Add
    </a>
</div>
<div class="card flex-fill mt-3">
    <table class="table my-0 table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @forelse ($faqs as $faq)
            <tr>
                <td>
                    {{ $i++; }}
                </td>
                <td>
                    {{ $faq->title }}
                </td>
                <td>
                    {{ $faq->category->title }}
                </td>
                <td>
                    @if ($faq->status === 'enable')
                    <span class="badge bg-success">{{ $faq->status }}</span>
                    @else
                    <span class="badge bg-warning">{{ $faq->status }}</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('faqs.edit', $faq) }}" class="btn btn-sm btn-primary"><i
                            class="align-middle" data-feather="edit-2"></i>
                        <span class="align-middle"> Edit </span> </a>
                    <form action="{{ route('faqs.destroy', $faq) }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button title="Delete" class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure want to delete this: {{ $faq->title }} ?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">No FAQs Found...</td>
            </tr>
            @endforelse


        </tbody>
    </table>
</div>
<div class="pagination-area mt-3">
    {{ $faqs->links('vendor.pagination.bootstrap-5') }}
</div>
@endsection

{{-- @push('js')
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
@endpush --}}
