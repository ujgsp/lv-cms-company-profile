@extends('layouts.dashboard')

@section('title')
    Add Member
@endsection

@section('description')
    Create a New Member for your Website.
@endsection

@section('content')
    <div class="mt-3 card">
        <div class="card-body">
            <form method="POST" action="{{ route('members.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label " for="name">Name <span class="text-danger">*</span></label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                            id="name"
                            placeholder="Enter name" value="{{ old('name') }}">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label " for="designation">Designation <span class="text-danger">*</span></label>
                        <input class="form-control @error('designation') is-invalid @enderror" type="text"
                            name="designation" id="designation"
                            placeholder="Enter designation" value="{{ old('designation') }}">

                        @error('designation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image <span class="text-danger">*</span> </label>
                    <label class="form-label">(Best resolution width - 263 px, height - 300 px)</label>
                    <div id="showImage"></div>
                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                        name="image" onchange="previewFileAdd(this, 'showImage')" accept="image/png, image/gif, image/jpeg" />

                    <small class="text-muted">Allowed File Types: PNG, JPG, JPEG Only</small>

                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label" for="facebook">Facebook URL (Optional) </label>
                        <input class="form-control @error('facebook') is-invalid @enderror" type="text" name="facebook"
                            id="facebook"
                            placeholder="Enter facebook" value="{{ old('facebook') }}">

                        <small class="text-muted mt-3">e.g. <span
                                class="text-danger">https://facebook.com/janesmith</span></small>

                        @error('facebook')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label " for="instagram">Instagram URL (Optional) </label>
                        <input class="form-control @error('instagram') is-invalid @enderror" type="text" name="instagram"
                            id="instagram"
                            placeholder="Enter instagram" value="{{ old('instagram') }}">

                        @error('instagram')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label " for="twitter">Twitter URL (Optional) </label>
                        <input class="form-control @error('twitter') is-invalid @enderror" type="text" name="twitter"
                            id="twitter"
                            placeholder="Enter twitter" value="{{ old('twitter') }}">

                        @error('twitter')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label " for="linkedin">LinkedIn URL (Optional) </label>
                        <input class="form-control @error('linkedin') is-invalid @enderror" type="text" name="linkedin"
                            id="linkedin"
                            placeholder="Enter linkedin" value="{{ old('linkedin') }}">

                        @error('linkedin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label " for="email">Email (Optional) </label>
                        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                            id="email"
                            placeholder="Enter email" value="{{ old('email') }}">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label " for="phone">Phone (Optional) </label>
                        <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone"
                            id="phone"
                            placeholder="Enter phone" value="{{ old('phone') }}">

                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                    <a href="{{ route('members.index') }}" class="btn btn-danger btn-lg">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
