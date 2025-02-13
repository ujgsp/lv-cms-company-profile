@extends('layouts.dashboard')

@section('title')
    Edit Service
@endsection

@section('description')
    Edit a Service for your Website
@endsection

@section('content')
    
@if (session('error'))
        <div class="mt-3 alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="mt-3 card">
        <div class="card-body">
            <form method="POST" action="{{ route('services.update', ['service' => $service->slug]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="mb-3 row">
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                            <label class="form-label " for="title">Title <span class="text-danger">*</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                                id="title" placeholder="Enter title" value="{{ old('title', $service->title) }}">

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                            <label class="form-label " for="slug">Slug <span class="text-danger">*</span></label>
                            <input class="form-control @error('slug') is-invalid @enderror" type="text" name="slug"
                                id="slug" placeholder="Enter slug" value="{{ old('slug', $service->slug) }}">

                            <span id="slug-error" class="text-danger"></span>

                            @error('slug')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label" for="excerpt">Short Description <span
                                class="text-danger">*</span></label>
                        <textarea name="excerpt" rows="2" class="form-control @error('excerpt') is-invalid @enderror" id="inputSiteDesc">{{ $service->excerpt }}</textarea>

                        <small class="text-muted d-block mt-2">Use a short description that describes this service.</small>

                        @error('excerpt')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="thumbnail" class="form-label">Thumbnail <span class="text-danger">*</span></label>
                    <label class="form-label">Best resolution height - 64 px, width - 64 px</label>

                    @if ($service->image)
                        <div class="image-preview" id="showImage">
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                        </div>
                    @else
                        <div id="showImage"></div>
                    @endif

                    <input class="form-control @error('thumbnail') is-invalid @enderror" type="file" id="thumbnail"
                        onchange="previewFileAdd(this, 'showImage')" name="thumbnail"
                        accept="image/png, image/gif, image/jpeg" />

                    <small class="mt-2 text-muted d-block">Allowed File Types: PNG, JPG, JPEG Only</small>

                    @error('thumbnail')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label " for="description">Description <span class="text-danger">*</span></label>

                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{!! old('description', str_replace('src="storage', 'src="' . asset('storage'), $service->body)) !!}</textarea>

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
                    <input type="hidden" name="submit" value="true">
                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                    <a href="{{ route('services.index') }}" class="btn btn-danger btn-lg">Back</a>
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
        // Ambil elemen input judul dan slug
        var titleInput = document.getElementById('title');
        var slugInput = document.getElementById('slug');
        var slugError = document.getElementById('slug-error');

        // Tambahkan event listener untuk memantau perubahan pada input judul
        titleInput.addEventListener('change', function() {
            createSlug();
        });

        // Tambahkan event listener untuk memantau perubahan pada input slug
        slugInput.addEventListener('change', function() { // Added event listener for 'input' event
            checkSlugUniqueness(slugInput.value);
        });

        // Fungsi untuk membuat slug dari judul
        function createSlug() {
            var title = titleInput.value.trim().toLowerCase();
            var slug = title.replace(/\s+/g, '-'); // Ganti spasi dengan dash (-)
            slugInput.value = slug;

            // Periksa keunikan slug
            checkSlugUniqueness(slug);
        }

        // Tambahkan event listener untuk memantau perubahan pada input slug
        slugInput.addEventListener('change', function() {
            checkSlugUniqueness(slugInput.value);
        });


        // Fungsi untuk memeriksa keunikan slug
        function checkSlugUniqueness(slug) {
            fetch('/dashboard/services/checkSlug?slug=' + slug)
                .then(response => response.json())
                .then(data => {
                    if (data.unique) {
                        slugError.textContent = '';
                    } else {
                        slugError.textContent = 'Slug already exists. Please choose a different one.';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

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
