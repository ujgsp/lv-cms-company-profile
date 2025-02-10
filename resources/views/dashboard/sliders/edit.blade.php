@extends('layouts.dashboard')

@section('title')
    Edit Slider
@endsection

@section('description')
    Update a Slider for your Website.
@endsection

@section('content')
    <div class="mt-3 card">
        <div class="card-body">
            <form method="POST" action="{{ route('sliders.update', $slider) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label" for="text_primary">Text Primary <span class="text-danger">*</span></label>
                        <input class="form-control @error('text_primary') is-invalid @enderror" type="text"
                            name="text_primary"
                            id="text_primary"
                            placeholder="Enter text" value="{{ old('text_primary', $slider->text_primary) }}">

                        @error('text_primary')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label" for="text_secondary">Text Secondary <span
                                class="text-danger">*</span></label>
                        <input class="form-control @error('text_secondary') is-invalid @enderror" type="text"
                            name="text_secondary"
                            id="text_secondary"
                            placeholder="Enter text" value="{{ old('text_secondary', $slider->text_secondary) }}">

                        @error('text_secondary')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="thumbnail" class="form-label">Thumbnail <span class="text-danger">*</span></label>
                    <label class="form-label">Best resolution height - 800 px, width - 1600 px</label>

                    @if ($slider->thumbnail)
                        <div class="image-preview">
                            <img src="{{ asset('storage/' . $slider->thumbnail) }}" alt="{{ $slider->text_primary }}" id="previewImage">
                        </div>
                    @endif

                    <input class="form-control @error('thumbnail') is-invalid @enderror" type="file" id="thumbnail"
                        name="thumbnail" accept="image/png, image/gif, image/jpeg" onchange="previewFile(this, 'previewImage');">

                    <small class="text-muted">Allowed File Types: PNG, JPG, JPEG Only</small>

                    @error('thumbnail')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label" for="button_title">Button Title <span class="text-danger">*</span></label>
                        <input class="form-control @error('button_title') is-invalid @enderror" type="text"
                            name="button_title"
                            id="button_title"
                            placeholder="Enter title" value="{{ old('button_title', $slider->btn_title) }}">

                        @error('button_title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label" for="button_link">Button Link <span class="text-danger">*</span></label>
                        <input class="form-control @error('button_link') is-invalid @enderror" type="text"
                            name="button_link"
                            id="button_link"
                            placeholder="Enter url" value="{{ old('button_link', $slider->btn_link) }}">

                        <small class="text-muted">e.g. <span
                                class="text-danger">https://www.example.com/products</span></small>

                        @error('button_link')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="">
                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                    <a href="{{ route('sliders.index') }}" class="btn btn-danger btn-lg">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
