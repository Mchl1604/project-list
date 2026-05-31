@extends('layouts.userApp')

@section('title', 'Users')

@section('content')
    <div class="mt-5 mb-3 d-flex flex-wrap justify-content-between align-items-start gap-3">
        <div>
            <h2 class="green-font mb-1">User Management</h2>
            <p class="text-white mb-0">Manage all registered users in the system. You can edit user information or delete users as needed.</p>
        </div>
        <div>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="bi bi-plus-lg"></i> Add New User
            </button>
        </div>
    </div>
    

    
    <table class="table table-dark table-bordered border-success">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Date Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('m-d-Y') }}</td>
                    <td>
                      <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                        <i class="bi bi-pencil"></i>
                      </button>
                      <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUserModal{{ $user->id }}">
                        <i class="bi bi-trash"></i>
                      </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @foreach ($users as $user )
        <div class="modal fade
            " id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Edit User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body
                            ">
                            <div class="mb-3">
                                <label for="name{{ $user->id }}" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name{{ $user->id }}" name="name" value="{{ $user->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email{{ $user->id }}" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email{{ $user->id }}" name="email" value="{{ $user->email }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteUserModalLabel{{ $user->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('users.delete', $user->id) }}">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteUserModalLabel{{ $user->id }}">Confirm Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body
                            ">
                            <p>Are you sure you want to delete user <strong>{{ $user->name }}</strong>?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    @endforeach

    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body
                        ">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection
