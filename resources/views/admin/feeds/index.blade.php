@extends('layouts.admin')

@section('content')
    <div class="container">

        <h3>Manage Feeds</h3>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        <form method="GET" action="{{ route('admin.feeds.index') }}">
            <div class="row mb-3">

                <div class="col-md-4">
                    <input type="text" name="search" value="{{ $search }}" class="form-control"
                        placeholder="Search by title or username">
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary">Search</button>
                </div>

            </div>
        </form>



        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Title</th>
                    <th>Images</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($feeds as $feed)
                    <tr>

                        <td>{{ $feed->id }}</td>

                        <td>{{ $feed->user->name ?? '' }}</td>

                        <td>{{ $feed->title }}</td>

                        <td>

                            @foreach ($feed->images as $image)
                                <img src="{{ asset('storage/' . $image->image) }}" width="60" style="margin:2px">
                            @endforeach

                        </td>

                        <td>

                            <a href="{{ route('admin.feeds.show', $feed->id) }}" class="btn btn-info btn-sm">

                                View

                            </a>

                            <form action="{{ route('admin.feeds.delete', $feed->id) }}" method="POST">

                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Delete this feed?')" class="btn btn-danger btn-sm">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>
                @endforeach

            </tbody>

        </table>

        {{ $feeds->links() }}

    </div>
@endsection
