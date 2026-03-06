@extends('layouts.admin')

@section('content')
 <div class="container" >

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

  <div class="panel panel-default">

                                <div class="panel-heading">

                                    <h3>Variations List </h3>

                                </div>

                                <div class="panel-body">   


<table class="table table-bordered">
    <tr>
        <th>Serial</th>
        <th>Product</th>
       
        <th>Action</th>
    </tr>
    @foreach($variations as $variation)
    <tr>
        <td>{{ $variation->serial_number }}</td>
        <td>{{ $variation->product_id }}</td>
       
        <td>
            <a href="{{ route('admin.variations.edit', $variation->id) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('admin.variations.destroy', $variation->id) }}" method="POST" style="display:inline;">
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


 </div>

@endsection
