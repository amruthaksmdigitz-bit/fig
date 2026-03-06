@extends('layouts.admin')

@section('content')
<h1>Contact Messages</h1>
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Received At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($messages as $msg)
        <tr>
            <td>{{ $msg->fname }} {{ $msg->lname }}</td>
            <td>{{ $msg->email }}</td>
            <td>{{ $msg->subject }}</td>
            <td>{{ $msg->message }}</td>
            <td>{{ $msg->created_at->format('d M Y, H:i') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection