@extends('layouts.dashboard')

@section('title')
    Edit FAQ
@endsection

@section('description')
    Edit a FAQ for your Website.
@endsection

@section('content')
    <div class="mt-3 card">
        <div class="card-body">
            <form method="POST" action="{{ route('faqs.update', $faq) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                            id="title"
                            placeholder="Enter title" value="{{ old('title', $faq->title) }}">

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label" for="category_id">Category <span class="text-danger">*</span></label>
                        <select class="form-control @error('category_id') is-invalid @enderror" name="category_id"
                            id="category_id">
                            <option value="" disabled>Choose..</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ (old('category_id', $faq->category_id) == $category->id) ? 'selected' : '' }}>{{ $category->title }}
                            </option>
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
                        <label class="form-label" for="description">Description <span class="text-danger">*</span></label>
                        <textarea id="body" name="description"
                            class="form-control @error('description') is-invalid @enderror">{!! old('description', $faq->body) !!}</textarea>
                        <small class="mt-2 text-muted d-block">Use the Editor to compose your page, or you may use
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
                        <label class="form-label" for="status">Page Status</label>
                        <div class="form-check form-switch form-switch-md float-end">
                            <input id="publish" class="form-check-input" {{ $faq->status === 'enable' ? 'checked=""' : '' }} value="enable" name="status"
                                type="checkbox">
                        </div>
                        <small class="text-muted d-block">Whether to Enable or Disable this page.</small>
                    </div>
                </div>

                <div class="">
                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                    <a href="{{ route('faqs.index') }}" class="btn btn-danger btn-lg">Back</a>
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
    </script>
@endpush
