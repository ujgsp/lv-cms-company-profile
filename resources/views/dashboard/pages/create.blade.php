@extends('layouts.dashboard')

@section('title')
Add Page
@endsection

@section('description')
Create a New Page for your Website
@endsection

@section('content')
<div class="mt-3 card">
    <div class="card-body">
        <form method="POST" action="{{ route('pages.store') }}">
            @csrf
            <div class="mb-3 row">
                <div class="col-sm-12 col-lg-6">
                    <div class="form-group">
                        <label class="form-label " for="title">Page Title <span class="text-danger">*</span></label>
                        <input class="form-control @error('title')
                            is-invalid
                            @enderror" type="text" name="title" id="title" placeholder="Choose A Page Title"
                            value="{{ old('title') }}">

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
                        <input class="form-control @error('slug')
                            is-invalid
                            @enderror " type="text" name="slug" id="slug" value="{{ old('slug') }}"
                            placeholder="Choose A Page Slug">

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
                    <label class="form-label " for="body">Page Content <span class="text-danger">*</span></label>
                    <textarea id="body" name="body"
                        class="form-control @error('body') is-invalid @enderror">{!! old('body') !!}</textarea>
                    <small class="mt-2 text-muted d-block">Use the Editor to compose your page, or you may use
                        HTML.</small>

                    @error('body')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label " for="location">Page Location <span class="text-danger">*</span></label>
                    <select class="form-control @error('location')
                        is-invalid
                        @enderror" name="location" id="location">
                        <option value="" disabled {{ old('location')===null ? 'selected' : '' }}>Choose..
                        </option>
                        <option value="header" {{ old('location')==='header' ? 'selected' : '' }}>Header</option>
                        <option value="footer" {{ old('location')==='footer' ? 'selected' : '' }}>Footer</option>
                        <option value="both" {{ old('location')==='both' ? 'selected' : '' }}>Both</option>
                    </select>
                    <small class="mt-2 text-muted d-block">Choose the Location of this Page Link.</small>

                    @error('location')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label " for="status">Page Status</label>
                    <div class="form-check form-switch form-switch-md float-end">
                        <input id="publish" class="form-check-input" checked="" value="publish" name="status"
                            type="checkbox">
                    </div>
                    <small class="text-muted d-block">Whether to Enable or Disable this page.</small>
                </div>
            </div>


            <div class="mb-3">
                <input type="hidden" name="submit" value="true">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('pages.index') }}" class="btn btn-danger">Back</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet">
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
@endpush

@push('js')
<script>
    $(document).ready(function() {
        $('#body').summernote({
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
    });

    // Ambil elemen input judul dan slug
    var titleInput = document.getElementById('title');
    var slugInput = document.getElementById('slug');
    var slugError = document.getElementById('slug-error');

    // Tambahkan event listener untuk memantau perubahan pada input judul
    titleInput.addEventListener('change', function() {
        createSlug();
    });

    // Tambahkan event listener untuk memantau perubahan pada input slug
    slugInput.addEventListener('change', function() {
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

    // Fungsi untuk memeriksa keunikan slug
    function checkSlugUniqueness(slug) {
        fetch('/dashboard/pages/checkSlug?slug=' + slug)
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
</script>

@endpush
