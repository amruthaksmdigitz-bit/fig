@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>User List</h1>
    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Profile</th>
                <th>Name</th>
                <th>Email</th>
                <th>Location</th>
                <th>Cover Image</th>
                <th>Multiple Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>

                <td>
                    @if($user->profile_image)
                    <img src="{{ asset($user->profile_image) }}" alt="Profile" class="rounded-circle" width="50" height="50">
                    @else
                    <span class="text-muted">No image</span>
                    @endif
                </td>

                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td> {{ $user->locationRelation ? $user->locationRelation->name : 'N/A' }}</td>
                <td>
                    @if($user->cover_image)
                    <img src="{{ asset($user->cover_image) }}" alt="Cover" class="img-thumbnail" width="50" height="35">
                    @else
                    <span class="text-muted">No image</span>
                    @endif
                </td>

                <td>
                    @if($user->multipleImages->count())
                    <img src="{{ asset($user->multipleImages->first()->image) }}" alt="Gallery" class="img-thumbnail" width="50">
                    @else
                    <span class="text-muted">No Multiple images</span>
                    @endif
                </td>

             
				
				  <td>
				  
				  
            @if($user->is_approved)
				
			Approved
			 @else
				 Not approved
			  @endif
				 
    <div class="dropdown">
        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
            Actions
        </button>
        <ul class="dropdown-menu">
            <li>
                <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-primary">View</a>
                  
            </li>
            <li>
                 <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">Edit</a>
            </li>
            <li><hr class="dropdown-divider"></li>
            
            @if($user->is_approved)
                <li>
                    <form action="{{ route('admin.users.unapprove', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        
                        <button type="submit" class="dropdown-item text-danger"
                            onclick="return confirm('Unapprove this user?')">
                            <i class="bi bi-x-circle me-2"></i> Unapprove
                        </button>
                    </form>
                </li>
            @else
                <li>
                    <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        
                        <button type="submit" class="dropdown-item text-success"
                            onclick="return confirm('Approve this user?')">
                            <i class="bi bi-check-circle me-2"></i> Approve
                        </button>
                    </form>
                </li>
            @endif
            
            <li><hr class="dropdown-divider"></li>
            <li>
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item text-danger"
                        onclick="return confirm('Delete this user permanently?')">
                        <i class="bi bi-trash me-2"></i> Delete
                    </button>
                </form>
            </li>
        </ul>
    </div>
</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
</div>
@endsection