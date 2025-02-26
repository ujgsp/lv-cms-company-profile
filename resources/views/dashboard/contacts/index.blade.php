@extends('layouts.dashboard')

@section('title')
    Emails
@endsection

@section('description')
    List of all emails on your website.
@endsection

@section('content')
    @if (session()->has('success'))
        <div class="mt-3 alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="mt-3 alert alert-danger alert-dismissible" role="alert">
            <div class="alert-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="tld-search-area">
        <div class="input-group tld-search-sec">
            <form class="row g-1" method="GET" action="{{ route('contacts.index') }}">
                <div class="col-auto">
                    <input type="text" name="query" class="form-control" value="{{ request('query') }}"
                        placeholder="Search">
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-3 card flex-fill">
        <div class="table-responsive">
            <table class="table my-0 table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @forelse ($contacts as $contact)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>
                                {{ $contact->created_at->format('M d, Y') }}</td>
                            </td>
                            <td>
                                <a href="{{ route('contacts.show', $contact) }}" class="btn btn-success btn-sm">
                                    <i class="align-middle" data-feather="eye"></i>
                                    Show
                                </a>
                                <form action="{{ route('contacts.destroy', $contact) }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button title="Delete" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure want to delete this data?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No contacts Found...</td>
                        </tr>
                    @endforelse


                </tbody>
            </table>
        </div>
    </div>
    <div class="pagination-area mt-3">
        {{ $contacts->links('vendor.pagination.bootstrap-5') }}
    </div>
@endsection

@push('css')
    <style>
        .btn{
            display: inline-block;
        }
    </style>
@endpush
