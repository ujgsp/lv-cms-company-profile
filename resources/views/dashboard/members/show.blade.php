@extends('layouts.dashboard')

@section('title')
    Profile Member
@endsection


@section('content')
    <div class="row mt-3">
        <div class="col-md-4 col-xl-3">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Profile Details</h5>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset('storage/'. $member->image) }}" alt="Christina Mason" class="img-fluid rounded-circle mb-2 justify-content-center align-items-center" style="overflow: hidden; width: 128px; height: 128px; max-width: 100%; max-height: 100%; object-fit: cover;">
                    <h5 class="card-title mb-2">{{ $member->name }}</h5>
                    <div class="text-muted mb-0">{{ $member->designation }}</div>

                </div>
                <hr class="my-0">
                <div class="card-body">
                    <h5 class="h6 card-title">Status</h5>
                    @if ($member->status === 'enable')
                    <a href="#" class="badge bg-success me-1 my-1">{{ $member->status }}</a>
                    @else
                    <a href="#" class="badge bg-secondary me-1 my-1">{{ $member->status }}</a>
                    @endif

                </div>
                <hr class="my-0">
                <div class="card-body">
                    <h5 class="h6 card-title">Elsewhere</h5>
                    <ul class="list-unstyled mb-0">
                        @if($member->facebook_url)
                            <li class="mb-1"><a target="_blank" href="{{ $member->facebook_url }}" target="_blank">Facebook</a></li>
                        @endif
                        @if($member->twitter_url)
                            <li class="mb-1"><a target="_blank" href="{{ $member->twitter_url }}" target="_blank">Twitter</a></li>
                        @endif
                        @if($member->instagram_url)
                            <li class="mb-1"><a target="_blank" href="{{ $member->instagram_url }}" target="_blank">Instagram</a></li>
                        @endif
                        @if($member->linkedin_url)
                            <li class="mb-1"><a target="_blank" href="{{ $member->linkedin_url }}" target="_blank">LinkedIn</a></li>
                        @endif
                        @if($member->email)
                            <li class="mb-1"><a target="_blank" href="mailto:{{ $member->email }}" target="_blank">Email</a></li>
                        @endif
                        @if($member->phone)
                            <li class="mb-1"><a target="_blank" href="tel:{{ $member->phone }}" target="_blank">Phone</a></li>
                        @endif
                    </ul>
                    <a href="{{ route('members.index') }}" class="btn btn-danger btn-lg mt-3">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        hr{
            height: 0.5px !important;
        }
    </style>
@endpush
