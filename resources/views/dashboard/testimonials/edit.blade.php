@extends('layouts.dashboard')

@section('title')
    Edit Testimonial
@endsection

@section('description')
    Update a Testimonial for your Website.
@endsection

@section('content')
    <div class="mt-3 card">
        <div class="card-body">
            <form method="POST" action="{{ route('testimonials.update', $testimonial) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label " for="name">Name <span class="text-danger">*</span></label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                            id="name"
                            placeholder="Enter name" value="{{ old('name', $testimonial->name) }}">

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
                            placeholder="Enter designation" value="{{ old('designation', $testimonial->designation) }}">

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
                            placeholder="Enter organization" value="{{ old('organization', $testimonial->organization) }}">

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

                        <textarea class="form-control @error('description') is-invalid @enderror" rows="2" placeholder="Enter description" name="description" id="description" spellcheck="false">{{ old('description',$testimonial->description) }}</textarea>

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


                    @if ($testimonial->image)
                    <div class="image-preview" id="showImage">
                        <img src="{{ asset('storage/'. $testimonial->image) }}" alt="{{ $testimonial->name }}">
                    </div>

                    @endif

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
                    <div class="form-group">
                        <label class="form-label" for="status">Status</label>
                        <div class="form-check form-switch form-switch-md float-end">
                            <input id="publish" class="form-check-input" {{ $testimonial->status === 'enable' ? 'checked=""' : '' }} value="enable" name="status" type="checkbox">
                        </div>
                        <small class="text-muted d-block">Whether to Enable or Disable this page.</small>
                    </div>
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
