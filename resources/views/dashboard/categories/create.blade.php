@extends('layouts.dashboard')

@section('title')
Add Category
@endsection

@section('description')
Add a New Category for your Website.
@endsection

@section('content')
<div class="mt-3 card">
    <div class="card-body">
        <form method="POST" action="{{ route('categories.store') }}">
            @csrf
            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label " for="title">Title <span class="text-danger">*</span></label>
                    <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title"
                        placeholder="Enter title">

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
                        placeholder="Enter slug">

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
                    <label class="form-label" for="type">Type <span class="text-danger">*</span></label>
                    <select class="form-select @error('type') is-invalid @enderror" name="type"
                        id="type">
                        <option value="" selected disabled>Choose..</option>
                        <option value="news">News</option>
                        <option value="project">Project</option>
                        <option value="faq">FAQ</option>
                    </select>

                    @error('type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>


            <div class="">
                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                <a href="{{ route('categories.index') }}" class="btn btn-danger btn-lg">Back</a>
            </div>
        </form>
    </div>
</div>
@endsection

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
        fetch('/dashboard/categories/checkSlug?slug=' + slug)
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
