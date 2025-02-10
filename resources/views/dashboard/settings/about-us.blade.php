@extends('layouts.dashboard')

@section('title')
    About Us
@endsection

@section('description')
Configure About Your Website.
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

    <div class="mt-3 card">
        <div class="card-body">
            <form method="POST" action="{{ route('about.update', ['option' => 'setting_about_us']) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                            id="title" value="{{ old('title', $opt_about_us->title) }}">

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="thumbnail" class="form-label">Thumbnail <span class="text-danger">*</span></label>
                    <label class="form-label">(Best resolution width - 1600 px, height - Any px)</label>


                    <div class="image-preview">
                        @if ($opt_about_us->thumbnail)
                            <img src="{{ asset('storage/' . $opt_about_us->thumbnail) }}" alt="" id="previewImage">
                            <input type="hidden" name="oldImage" value="{{ $opt_about_us->thumbnail }}">
                        @else
                            <img src="http://127.0.0.1:8000/static/images/logo.png" alt="" id="previewImage">
                        @endif

                    </div>


                    <input class="form-control @error('thumbnail') is-invalid @enderror" type="file" id="thumbnail"
                        name="thumbnail" autocomplete="off" accept="image/png, image/gif, image/jpeg" onchange="previewFile(this, 'previewImage');">

                    @error('thumbnail')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <label class="form-label"><small>Allowed File Types: PNG, JPG, JPEG Only</small></label>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label" for="description">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{!! old('description', $opt_about_us->description) !!}</textarea>
                        <small class="mt-2 text-muted d-block">Use the Editor to compose your post, or you may use
                            HTML.</small>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label" for="short_description">Short Description <span class="text-danger">*</span></label>

                        <textarea rows="2" class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description">{{ old('short_description', $opt_about_us->short_description) }}</textarea>

                        <small class="mt-2 text-muted d-block">A brief description of your website</small>

                        @error('short_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="">
                    <button type="submit" class="btn btn-primary btn-lg">Update</button>
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
@endpush

@push('js')
    <script>
        // summernote
        $('#description').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['codeview', 'help']]
            ],
            height: 200,
        });
    </script>
@endpush
