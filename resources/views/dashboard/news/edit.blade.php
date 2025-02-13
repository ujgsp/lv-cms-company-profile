@extends('layouts.dashboard')

@section('title')
Edit News
@endsection

@section('description')
Edit a News for your Website
@endsection

@section('content')

@if(session('error'))
    <div class="mt-3 alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="mt-3 card">
    <div class="card-body">
        <form method="POST" action="{{ route('news.update', ['news' => $news->slug]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3 row">
                <div class="col-sm-12 col-lg-6">
                    <div class="form-group">
                        <label class="form-label " for="title">Title <span class="text-danger">*</span></label>
                        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                            id="title" placeholder="Enter title" value="{{ old('title', $news->title) }}">

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
                            id="slug" placeholder="Enter slug" value="{{ old('slug', $news->slug) }}">

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
                    <label class="form-label" for="category_id">Categories <span class="text-danger">*</span></label>
                    <select class="form-select @error('category_id') is-invalid @enderror" name="category_id"
                        id="category_id">
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $news->category_id == $category->id ? 'selected' : ''  }} >{{ $category->title }}</option>
                        @endforeach
                    </select>

                    @error('category_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label" for="tags">Tags <span class="text-danger">*</span></label>
                    <input class="form-control  @error('tags') is-invalid @enderror" type="text" name="tags" id="tags" value="{{ old('tags', $news->tags) }}"
                        placeholder="Enter Tags Comma Separated">

                    @error('tags')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>


            <div class="mb-3">
                <label for="thumbnail" class="form-label">Thumbnail <span class="text-danger">*</span></label>
                <label class="form-label">Select Image (698 x 465 Recommended)</label>

                @if ($news->thumbnail)
                <div class="image-preview" id="showImage">
                    <img src="{{ asset('storage/'. $news->thumbnail) }}" alt="{{ $news->title }}"id="profileImg" class="img-fluid">
                </div>
                @else
                    <div id="showImage"></div>
                @endif

                <input class="form-control @error('thumbnail') is-invalid @enderror" type="file" id="thumbnail"
                    name="thumbnail" accept="image/png, image/gif, image/jpeg" onchange="previewFileAdd(this, 'showImage')">

                <label class="form-label"><small>Allowed File Types: PNG, JPG, JPEG Only</small></label>

                @error('thumbnail')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label " for="content">Content <span class="text-danger">*</span></label>

                    <textarea class="form-control @error('content') is-invalid @enderror" name="content"
                        id="content">{{ old('content', $news->body) }}</textarea>

                    <small class="mt-2 text-muted d-block">Use the Editor to compose your post, or you may use
                        HTML.</small>

                    @error('content')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label " for="publish">Publish</label>
                    <div class="form-check form-switch form-switch-md float-end">
                        <input id="publish" class="form-check-input" {{ $news->status == 'publish' ? 'checked=""' : '' }} name="publish" type="checkbox">
                    </div>
                    <small class="text-muted d-block">Only Published Posts Are Displayed on Front-End. You can just Save
                        it &amp; Publish it Later</small>
                </div>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                <a href="{{ route('news.index') }}" class="btn btn-danger btn-lg">Back</a>
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
        fetch('/dashboard/news/checkSlug?slug=' + slug)
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
    $('#content').summernote({
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
