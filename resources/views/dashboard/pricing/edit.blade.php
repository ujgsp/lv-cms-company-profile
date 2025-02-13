@extends('layouts.dashboard')

@section('title')
Edit Pricing
@endsection

@section('description')
Edit a Pricing for your Website
@endsection

@section('content')

@if(session('error'))
    <div class="mt-3 alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="mt-3 card">
    <div class="card-body">
        <form method="POST" action="{{ route('pricings.update', $pricing->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                    <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" placeholder="Enter title" value="{{ old('title', $pricing->name) }}">

                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label" for="currency">Currency <span class="text-danger">*</span></label>
                    <input class="form-control @error('currency') is-invalid @enderror" type="text" name="currency" id="currency" placeholder="Enter currency" value="{{ old('currency', $pricing->currency) }}">

                    <small class="mt-2 text-muted d-block">Enter the currency for the pricing plan, e.g., $ for USD, € for EUR, Rp for Rupiah.</small>

                    @error('currency')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label" for="price">Price <span class="text-danger">*</span></label>
                    <input class="form-control @error('price') is-invalid @enderror" type="text" name="price" id="price" placeholder="Enter price" value="{{ old('price', $pricing->price) }}">

                    @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label" for="quantity">Quantity <span class="text-danger">*</span></label>
                    <input class="form-control @error('quantity') is-invalid @enderror" type="text" name="quantity" id="quantity" placeholder="Enter quantity" value="{{ old('quantity', $pricing->duration) }}">

                    <small class="mt-2 text-muted d-block">Enter the quantity available.</small>

                    @error('quantity')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            @foreach(old('features', $features) as $index => $feature)
                <div class="mb-3" id="inputFormField">
                    <label class="form-label" for="features">Feature Name <span class="text-danger">*</span></label>
                    <div class="row g-3">
                        <div class="col-8">
                            <input type="text" class="form-control @error('features.' . $index) is-invalid @enderror" placeholder="Enter feature name" name="features[]" value="{{ $feature }}">
                            @error('features.' . $index)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-auto">
                            <button type="button" id="removeField" class="btn btn-danger w-100">Remove</button>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="mb-3" id="newField"></div>

            <div class="mb-3">
                <button type="button" id="addField" class="btn btn-success">Add Feature</button>
            </div>

            <div class="">
                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                <a href="{{ route('pricings.index') }}" class="btn btn-danger btn-lg">Back</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
    (function ($) {
        "use strict";
        var featureIndex = {{ count(old('features', $features)) }};

        // add Field
        $(document).on('click', '#addField', function () {
            var html = '';
            html += '<div class="mb-3" id="inputFormField">';
            html += '<div class="row g-3">';
            html += '<div class="col-8">';
            html += '<input type="text" class="form-control" placeholder="Enter feature name" name="features[]">';
            html += '</div>';
            html += '<div class="col-auto"><button type="button" id="removeField" class="btn btn-danger w-100">Remove</button></div>';
            html += '</div>';
            html += '</div>';

            $('#newField').append(html);
        });

        // remove Field
        $(document).on('click', '#removeField', function () {
            $(this).closest('#inputFormField').remove();
        });
    }(jQuery));
</script>
@endpush
