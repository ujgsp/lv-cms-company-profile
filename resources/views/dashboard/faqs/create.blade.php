@extends('layouts.dashboard')

@section('title')
    Add FAQ
@endsection

@section('description')
    Add a New FAQ for your Website.
@endsection

@section('content')
    <div class="mt-3 card">
        <div class="card-body">
            <form method="POST" action="{{ route('faqs.store') }}">
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

                {{-- <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label" for="category_id">Category <span class="text-danger">*</span></label>
                        <select class="form-control @error('category_id') is-invalid @enderror" name="category_id"
                            id="category_id">
                            <option value="" disabled {{ old('location') === null ? 'selected' : '' }}>Choose..</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') === $category->id ? 'selected' : '' }}>{{ $category->title }}
                                </option>
                            @endforeach
                        </select>

                        @error('category_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div> --}}

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label" for="category_id">Categories <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <select class="form-select @error('category_id') is-invalid @enderror" name="category_id"
                                id="category_id" aria-label="Select category">
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                            <button title="Add New Category" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addCategoryModal">
                                <i class="align-middle" data-feather="plus"></i>
                            </button>
                        </div>

                        @error('category_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label" for="description">Description <span class="text-danger">*</span></label>
                        <textarea id="body" name="description"
                            class="form-control @error('description') is-invalid @enderror">{!! old('description') !!}</textarea>
                        <small class="mt-2 text-muted d-block">Use the Editor to compose your page, or you may use
                            HTML.</small>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="">
                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                    <a href="{{ route('faqs.index') }}" class="btn btn-danger btn-lg">Back</a>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal for adding category -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span id="validationErrors"></span>
                <!-- Form to add new category -->
                <form id="addCategoryForm" action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="titleCategory" class="form-label">Title  <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="titleCategory" name="titleCategory">

                    </div>
                    <div class="mb-3">
                        <label for="slugCategory" class="form-label">Slug  <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="slugCategory" name="slugCategory">
                        <span id="slug-error-category" class="text-danger"></span>
                        <input type="hidden" name="typeCategory" value="faq">
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary float-end">Save changes</button>
                </form>
            </div>
        </div>
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
    </script>
    <script>
        $(document).ready(function() {
            // Ambil elemen input judul dan slug
            var titleInput = document.getElementById('titleCategory');
            var slugInput = document.getElementById('slugCategory');
            var slugError = document.getElementById('slug-error-category');

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

            // Function to handle form submission for adding new category
            $('#addCategoryForm').submit(function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Get the form data
                var formData = new FormData(this);

                // Send a POST request to add the new category
                $.ajax({
                    url: '{{ route('categories.storeFromAjax') }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (data.success) {
                            // If the category is added successfully, close the modal
                            // var modal = new bootstrap.Modal(document.getElementById('addCategoryModal'));
                            // modal.hide();
                            $("#addCategoryModal").modal('hide');

                            // Clear the form fields
                            $('#addCategoryForm')[0].reset();

                            // Refresh the category select options
                            refreshCategoryOptions();
                        }
                        // else {
                        //     // If there are validation errors, display them
                        //     // You can handle this part based on your backend response format
                        //     // For example, you can display the error messages in the modal
                        // }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 422) {
                            // If validation errors occur, display them
                            var errors = xhr.responseJSON.errors;
                            var errorMessages = Object.values(errors).flat().join('<br>');
                            // Display error messages to the user
                            $('#validationErrors').html('<div class="alert alert-danger">' + errorMessages + '</div>');
                        } else {
                            console.error(xhr.responseText);
                        }
                    }
                });
            });

            // Function to refresh the category select options after adding a new category
            function refreshCategoryOptions() {
                // Send a GET request to fetch updated category options
                $.get('{{ route('categories.options', ['type' => 'faq']) }}', function(data) {
                    // Replace the current category options with the updated options
                    $('#category_id').empty(); // Clear the current options

                    // Add the updated options
                    $.each(data, function(index, category) {
                        $('#category_id').append('<option value="' + category.id + '">' + category.title + '</option>');
                    });
                });
            }

            // Function to show modal when "Tambah Category" button is clicked
            $('#addCategoryButton').click(function() {
                var modal = new bootstrap.Modal(document.getElementById('addCategoryModal'));
                modal.show();
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var inputs = document.querySelectorAll('input');

            inputs.forEach(function(input) {
                input.setAttribute('autocomplete', 'off');
            });
        });
    </script>
@endpush
