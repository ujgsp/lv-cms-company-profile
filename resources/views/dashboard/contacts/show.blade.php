@extends('layouts.dashboard')

@section('title')
    Detail Email
@endsection


@section('content')
<div class="card flex-fill mt-3">
    <div class="card-body">

        <table class="table mt-2 mb-3">
            <tbody>
                <tr>
                    <th>Name</th>
                    <td>{{ $contact->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $contact->email }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $contact->phone }}</td>
                </tr>
                <tr>
                    <th>Message</th>
                    <td>{{ $contact->message}}</td>
                </tr>
                <tr>
                    <th>Subject</th>
                    <td>{{ $contact->subject}}</td>
                </tr>
            </tbody>
        </table>


        <a href="{{ route('contacts.index') }}" class="btn btn-danger btn-lg mt-3">Back</a>
    </div>
</div>
@endsection
