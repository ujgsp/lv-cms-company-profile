@extends('layouts.dashboard')

@section('title')
    Add Testimonial
@endsection

@section('description')
    Create a New Testimonial for your Website.
@endsection

@section('content')
    <div class="mt-3 card">
        <div class="card-body">
            <form method="POST" action="{{ route('testimonials.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label " for="name">Name <span class="text-danger">*</span></label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                            id="name"
                            placeholder="Enter name" value="{{ old('name') }}">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label " for="designation">Designation <span class="text-danger">*</span></label>
                        <input class="form-control @error('designation') is-invalid @enderror" type="text"
                            name="designation" id="designation"
                            placeholder="Enter designation" value="{{ old('designation') }}">

                        @error('designation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label " for="organization">Organization (Optional)</label>
                        <input class="form-control @error('organization') is-invalid @enderror" type="text"
                            name="organization" id="organization"
                            placeholder="Enter organization" value="{{ old('organization') }}">

                        @error('organization')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label" for="description">Description <span class="text-danger">*</span></label>

                        <textarea class="form-control @error('description') is-invalid @enderror" rows="2" placeholder="Enter description" name="description" id="description" spellcheck="false"></textarea>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image <span class="text-danger">*</span></label>
                    <label class="form-label">Best resolution height- 100 px, width- 100 px</label>
                    <div id="showImage"></div>
                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                        name="image" onchange="previewFileAdd(this, 'showImage')" accept="image/png, image/gif, image/jpeg" />

                    <small class="text-muted">Allowed File Types: PNG, JPG, JPEG Only</small>

                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                    <a href="{{ route('testimonials.index') }}" class="btn btn-danger btn-lg">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var inputs = document.querySelectorAll('input');

        inputs.forEach(function(input) {
            input.setAttribute('autocomplete', 'off');
        });
    });
</script>
@endpush
