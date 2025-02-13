@extends('layouts.dashboard')

@section('title')
    Edit Header / Footer Links
@endsection

@section('description')
    Update the header and footer links for your website.
@endsection

@section('content')
    @if (session('error'))
        <div class="mt-3 alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="mt-3 card">
        <div class="card-body">
            <form method="POST" action="{{ route('links.update', $link) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                            id="title" placeholder="My New Link" value="{{ old('title', $link->title) }}">

                        <small class="text-muted">Name of the Link to be displayed.</small>

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label" for="location">Location <span class="text-danger">*</span></label>
                        <input class="form-control @error('location') is-invalid @enderror" type="text" name="location"
                            id="location" placeholder="https://example.com/page"
                            value="{{ old('location', $link->location) }}">

                        <small class="text-muted">User will go to this link after clicking your link.</small>

                        @error('location')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label" for="placement">Placement <span class="text-danger">*</span></label>

                        <select class="form-select @error('placement') is-invalid @enderror" name="placement">
                            <option value="both" {{ old('placement', $link->placement) == 'both' ? 'selected' : '' }}>Both
                            </option>
                            <option value="header" {{ old('placement', $link->placement) == 'header' ? 'selected' : '' }}>
                                Header</option>
                            <option value="footer" {{ old('placement', $link->placement) == 'footer' ? 'selected' : '' }}>
                                Footer</option>
                        </select>

                        <small class="text-muted">Where to place this link.</small>

                        @error('placement')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label" for="newTab">New Tab</label>
                        <div class="form-check form-switch form-switch-md float-end">
                            <input class="form-check-input" id="newTab" value="true" name="newTab" type="checkbox"
                                {{ old('newTab', $link->new_tab) ? 'checked' : '' }}>
                        </div>
                        <small class="text-muted d-block">Should this link open in a new Tab or Not.</small>
                    </div>
                </div>

                <div class="">
                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                    <a href="{{ route('links.index') }}" class="btn btn-danger btn-lg">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
