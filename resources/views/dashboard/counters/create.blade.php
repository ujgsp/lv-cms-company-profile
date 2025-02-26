@extends('layouts.dashboard')

@section('title')
    Add Counter
@endsection

@section('description')
    Create a New Counter for your Website.
@endsection

@section('content')
    @if (session('error'))
        <div class="mt-3 alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="mt-3 card">
        <div class="card-body">
            <form method="POST" action="{{ route('counters.store') }}">
                @csrf
                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                            id="title" placeholder="Enter text" value="{{ old('title') }}">

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label class="form-label" for="value">Value <span class="text-danger">*</span></label>
                        <input class="form-control @error('value') is-invalid @enderror" type="text" name="value"
                            id="value" placeholder="Enter number" value="{{ old('value') }}">

                        @error('value')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="">
                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                    <a href="{{ route('counters.index') }}" class="btn btn-danger btn-lg">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
