@extends('layouts.dashboard')

@section('title')
    Edit Why Choose Us
@endsection

@section('description')
    Update a Why Choose Us for your Website.
@endsection

@section('content')
    @if (session('error'))
        <div class="mt-3 alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="mt-3 card">
        <div class="card-body">
            <form method="POST" action="{{ route('usps.update', ['usp' => $usp->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                            id="title" placeholder="Enter title" value="{{ old('title', $usp->title) }}">

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Thumbnail <span class="text-danger">*</span></label>
                    <label class="form-label">Best resolution height - 64 px, width - 64 px</label>

                    @if ($usp->image)
                        <div class="image-preview" id="showImage">
                            <img src="{{ asset('storage/' . $usp->image) }}" alt="{{ $usp->name }}">
                        </div>
                    @endif

                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                        name="image" onchange="previewFileAdd(this, 'showImage')"
                        accept="image/png, image/gif, image/jpeg" />

                    <small class="text-muted">Allowed File Types: PNG, JPG, JPEG Only</small>

                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label" for="description">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                            placeholder="Enter description">{{ old('description', $usp->description) }}</textarea>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="">
                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                    <a href="{{ route('usps.index') }}" class="btn btn-danger btn-lg">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
