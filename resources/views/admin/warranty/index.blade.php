@extends('layouts.admin')

@section('content')
 <div class="container" >

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

  <div class="panel panel-default">

                                <div class="panel-heading">

                                    <h3>Warranty List </h3>

                                </div>

                                <div class="panel-body">   


<table class="table table-bordered">
    <tr>
        <th>Serial</th>
        <th>Phone</th>
        <th>Vehicle</th>
        <th>Address</th>
        <th>Expiry</th>
        <th>Action</th>
    </tr>
    @foreach($warranties as $warranty)
    <tr>
        <td>{{ $warranty->serial_number }}</td>
        <td>{{ $warranty->phone_number }}</td>
        <td>{{ $warranty->vehicle_number }}</td>
        <td>{{ $warranty->address }}</td>
        <td>{{ $warranty->expiry_date }}</td>
        <td>
            <a href="{{ route('admin.warranty.edit', $warranty->id) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('admin.warranty.destroy', $warranty->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
        </div>
</div>
{{ $warranties->links() }}

 </div>

@endsection
