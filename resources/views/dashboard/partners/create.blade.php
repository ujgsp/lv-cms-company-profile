@extends('layouts.dashboard')

@section('title')
    Add Partner
@endsection

@section('description')
    Create a New Partner for your Website.
@endsection

@section('content')
    <div class="mt-3 card">
        <div class="card-body">
            <form method="POST" action="{{ route('partners.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                            id="title"
                            placeholder="Enter title" value="{{ old('title') }}">

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image <span class="text-danger">*</span></label>
                    <label class="form-label">Best resolution height- 100 px, width- 200 px</label>

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
                    <div class="form-group">
                        <label class="form-label " for="description">Description (Optional)</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                            id="description">{{ old('description') }}</textarea>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label" for="website">Website (Optional) </label>
                        <input class="form-control @error('website') is-invalid @enderror" type="text" name="website"
                            id="website"
                            placeholder="Enter website" value="{{ old('website') }}">

                        <small class="text-muted mt-3">e.g. <span
                                class="text-danger">https://website.com</span></small>

                        @error('website')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="">
                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                    <a href="{{ route('partners.index') }}" class="btn btn-danger btn-lg">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/select2/js/select2.full.min.js"></script>
@endpush

@push('js')
    <script>

        // Inisialisasi Summernote untuk elemen project_information
        $('#description').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['codeview', 'help']]
            ],
            height: 200,
        });
    </script>
@endpush
