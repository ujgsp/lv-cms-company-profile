@extends('layouts.dashboard')

@section('title')
    Detail Quote
@endsection


@section('content')
<div class="card flex-fill mt-3">
    <div class="card-body">

        <table class="table mt-2 mb-3">
            <tbody>
                <tr>
                    <th>Name</th>
                    <td>{{ $quote->name }}</td>
                </tr>
                <tr>
                    <th>Company</th>
                    <td>{{ $quote->company ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $quote->email }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $quote->phone }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{ $quote->address . ', '. $quote->city }}</td>
                </tr>
                <tr>
                    <th>Prefer contact?</th>
                    <td>{{ $quote->prefer_contact == 'phone' ? 'Phone: '. $quote->phone : 'Email: ' . $quote->email }}</td>
                </tr>
                <tr>
                    <th>Message</th>
                    <td>{{ $quote->message}}</td>
                </tr>
                <tr>
                    <th>Service</th>
                    <td>{{ $quote->service->title}}</td>
                </tr>
            </tbody>
        </table>


        <a href="{{ route('quotes.index') }}" class="btn btn-danger btn-lg mt-3">Back</a>
    </div>
</div>
@endsection
