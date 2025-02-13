@extends('layouts.dashboard')

@section('title')
Edit Project
@endsection

@section('description')
Edit a New Project for your Website
@endsection

@section('content')

@if(session('error'))
    <div class="mt-3 alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="mt-3 card">
    <div class="card-body">
        <form method="POST" action="{{ route('projects.update', ['project' => $project->slug]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label " for="title">Title <span class="text-danger">*</span></label>
                    <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title"
                        placeholder="Enter title" value="{{ old('title', $project->title) }}">

                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label " for="slug">Slug <span class="text-danger">*</span></label>
                    <input class="form-control @error('slug') is-invalid @enderror" type="text" name="slug" id="slug"
                        placeholder="Enter slug" value="{{ old('slug', $project->slug) }}">

                    <span id="slug-error" class="text-danger"></span>

                    @error('slug')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label" for="categories">Categories <span class="text-danger">*</span></label>

                    <select class="form-control @error('categories') is-invalid @enderror" name="categories[]"
                        id="categories" multiple>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ in_array($category->id, old('categories',
                            $project->categories->pluck('id')->toArray())) ? 'selected' : '' }}>{{ $category->title }}
                        </option>
                        @endforeach
                    </select>


                    @error('categories')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>


            <div class="mb-3">
                <label for="thumbnail" class="form-label">Thumbnail <span class="text-danger">*</span></label>

                <div class="image-preview">
                    <img src="{{ asset('storage/'. $project->thumbnail) }}" alt="{{ $project->title }}" id="profileImg">
                </div>

                <input class="form-control @error('thumbnail') is-invalid @enderror" type="file" id="thumbnail"
                    name="thumbnail" onchange="previewFile(this);" accept="image/png, image/gif, image/jpeg">

                @error('thumbnail')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label " for="description">Description <span class="text-danger">*</span></label>

                    <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                        id="description">{!! old('description', $project->body) !!}</textarea>

                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label " for="project_information">Project Information <span
                            class="text-danger">*</span></label>

                    <textarea class="form-control @error('project_information') is-invalid @enderror"
                        name="project_information"
                        id="project_information">{!! old('project_information', $project->project_info) !!}</textarea>

                    @error('project_information')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                <a href="{{ route('projects.index') }}" class="btn btn-danger btn-lg">Back</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<link href="https://adminlte.io/themes/v3/plugins/select2/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="https://adminlte.io/themes/v3/plugins/select2/js/select2.full.min.js"></script>
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
        fetch('/dashboard/projects/checkSlug?slug=' + slug)
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

    $('#project_information').summernote({
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

<script>
    $(document).ready(function() {
        $('#categories').select2({
            placeholder: "Choose..",
            allowClear: true,
            theme: 'bootstrap4'
        });
    });
</script>

<script>
    function previewFile(input) {
		var file = $("input[type=file]").get(0).files[0];

		if (file) {
			var reader = new FileReader();

			reader.onload = function() {
				$("#profileImg").attr("src", reader.result);
			}

			reader.readAsDataURL(file);
		}
	}
</script>
@endpush
