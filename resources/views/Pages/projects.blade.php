@extends('layouts.userApp')

@section('title', 'Projects')

@section('content')
    <div class="d-flex justify-content-between align-items-center mt-4">
        <h1 class="text-white">List of Projects</h1>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createProjectModal">
            Create New Project
        </button>
    </div>

    <table class="table table-dark table-bordered border-success mt-4">
        <thead>
            <tr>
                <th>Num</th>
                <th>Name</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($projects as $project)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $project->name }}</td>
                    <td>
                        <span @class([
                            'badge',
                            'bg-warning text-dark' => $project->status == 'Pending',
                            'bg-info text-dark' => $project->status == 'Ongoing',
                            'bg-success' => $project->status == 'Completed',
                        ])>{{ $project->status }}</span>
                    </td>
                    <td>
                        <span @class([
                            'badge',
                            'bg-info text-dark' => $project->priority == 'LOW',
                            'bg-warning text-dark' => $project->priority == 'MEDIUM',
                            'bg-danger' => $project->priority == 'HIGH',
                        ])>{{ $project->priority }}</span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($project->start_date)->format('F d, Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($project->end_date)->format('F d, Y') }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editProjectModal{{ $project->id }}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#deleteProjectModal{{ $project->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-warning">
                        No projects found. Please create a new project.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @foreach ($projects as $project)
        {{-- Edit Modal --}}
        <form method="POST" action="{{ route('projects.update', $project->id) }}">
            @csrf
            @method('PUT')
            <div class="modal fade" id="editProjectModal{{ $project->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit: {{ $project->name }}</h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Project Name</label>
                                <input type="text" name="name" class="form-control" required value="{{ $project->name }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="3" required>{{ $project->description }}</textarea>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="Pending" {{ $project->status == 'Pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="Ongoing" {{ $project->status == 'Ongoing' ? 'selected' : '' }}>
                                            Ongoing</option>
                                        <option value="Completed" {{ $project->status == 'Completed' ? 'selected' : '' }}>
                                            Completed</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Priority</label>
                                    <select name="priority" class="form-select">
                                        <option value="LOW" {{ $project->priority == 'LOW' ? 'selected' : '' }}>Low
                                        </option>
                                        <option value="MEDIUM" {{ $project->priority == 'MEDIUM' ? 'selected' : '' }}>
                                            Medium</option>
                                        <option value="HIGH" {{ $project->priority == 'HIGH' ? 'selected' : '' }}>High
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Start Date</label>
                                    <input type="date" name="start_date" class="form-control" required
                                        value="{{ \Carbon\Carbon::parse($project->start_date)->format('Y-m-d') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">End Date</label>
                                    <input type="date" name="end_date" class="form-control" required   
                                        value="{{ \Carbon\Carbon::parse($project->end_date)->format('Y-m-d') }}">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- Delete Modal --}}
        <form method="POST" action="{{ route('projects.delete', $project->id) }}">
            @csrf
            @method('DELETE')
            <div class="modal fade" id="deleteProjectModal{{ $project->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Delete {{ $project->name }}?</h5>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this project? This action cannot be undone.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endforeach

    {{-- Create Modal --}}
    <div class="modal fade" id="createProjectModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="{{ route('projects.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Project Name</label>
                                <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="3" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="Ongoing" {{ old('status') == 'Ongoing' ? 'selected' : '' }}>Ongoing
                                    </option>
                                    <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>
                                        Completed</option>
                                </select>
                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Priority</label>
                                <select name="priority" class="form-select" required>
                                    <option value="LOW" {{ old('priority') == 'LOW' ? 'selected' : '' }}>Low
                                    </option>
                                    <option value="MEDIUM" {{ old('priority') == 'MEDIUM' ? 'selected' : '' }}>Medium
                                    </option>
                                    <option value="HIGH" {{ old('priority') == 'HIGH' ? 'selected' : '' }}>High
                                    </option>
                                </select>
                                @error('priority')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Start Date</label>
                                <input type="date" name="start_date" class="form-control" required
                                    value="{{ old('start_date') }}">
                                @error('start_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">End Date</label>
                                <input type="date" name="end_date" class="form-control" required
                                    value="{{ old('end_date') }}">
                                @error('end_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Create Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endif

    @if (session('error'))
        <script>
            toastr.error("{{ session('error') }}");
        </script>
    @endif

@endsection
