@extends('layouts.userApp')

@section('title', 'Projects')

@section('content')
    <div class="d-flex justify-content-between align-items-center mt-4">
        <h1 class="text-center text-white">List of Projects</h1>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createProjectModal">Create New Project</button>
    </div>
    <table class="table table-dark table-bordered border-success mt-4">
        <thead>
            <tr>
                <th scope="col">Num</th>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">Priority</th>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($projects as $project)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $project->name }}</td>
                <td
                    @if ($project->status == 'Pending') class="text-warning"
                @elseif ($project->status == 'Ongoing')
                    class="text-info"
                @elseif ($project->status == 'Completed')
                    class="text-success" @endif>
                    {{ $project->status }}</td>
                <td
                    @if ($project->priority == 'LOW') class="text-info"
                @elseif ($project->priority == 'MEDIUM')
                    class="text-warning"
                @elseif ($project->priority == 'HIGH')
                    class="text-danger" @endif>
                    {{ $project->priority }}</td>
                <td>{{ \Carbon\Carbon::parse($project->start_date)->format('F d, Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($project->end_date)->format('F d, Y') }}</td>
                <td>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#editProjectModal{{ $project->id }}"> <i class="bi bi-pencil"></i></button>
                    <button class="btn btn-danger btn-sm"> <i class="bi bi-trash"></i></button>
                </td>
            </tr>
            <form method="POST" action="{{ route('projects.update', $project->id) }}">
                @csrf
                @method('PUT')
                <div class="modal fade" id="editProjectModal{{ $project->id }}" tabindex="-1"
                    aria-labelledby="editProjectModalLabel{{ $project->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editProjectModalLabel{{ $project->id }}">{{ $project->name }}
                                </h5>
                            </div>
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label>Project Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $project->name }}">
                                </div>
                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="3">{{ $project->description }}</textarea>
                                </div>
                                <div class="row g-3">
                                    <div class="mb-3 col-md-6">
                                        <label>Status</label>
                                        <select name="status" class="form-select">
                                            <option value="Pending" {{ $project->status == 'Pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="Ongoing" {{ $project->status == 'Ongoing' ? 'selected' : '' }}>
                                                Ongoing</option>
                                            <option value="Completed"
                                                {{ $project->status == 'Completed' ? 'selected' : '' }}>
                                                Completed</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label>Priority</label>
                                        <select name="priority" class="form-select">
                                            <option value="LOW" {{ $project->priority == 'LOW' ? 'selected' : '' }}>Low
                                            </option>
                                            <option value="MEDIUM" {{ $project->priority == 'MEDIUM' ? 'selected' : '' }}>
                                                Medium</option>
                                            <option value="HIGH" {{ $project->priority == 'HIGH' ? 'selected' : '' }}>
                                                High
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label>Start Date</label>
                                        <input type="date" name="start_date" class="form-control"
                                            value="{{ \Carbon\Carbon::parse($project->start_date)->format('Y-m-d') }}">
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label>End Date</label>
                                        <input type="date" name="end_date" class="form-control"
                                            value="{{ \Carbon\Carbon::parse($project->end_date)->format('Y-m-d') }}">
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Save Changes</button>
                            </div>
            </form>
            </div>
            </div>
            </div>
            @endforeach
        </tbody>
    </table>

    <div class="modal fade" id="createProjectModal" tabindex="-1" aria-labelledby="createProjectModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="createProjectModalLabel">Create New Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form method="POST" action="{{ route('projects.store') }}">
                    @csrf

                    <div class="modal-body">
                        <div class="row g-3">

                            <!-- Name -->
                            <div class="col-md-12">
                                <label class="form-label">Project Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="col-md-12">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
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

                            <!-- Priority -->
                            <div class="col-md-6">
                                <label class="form-label">Priority</label>
                                <select name="priority" class="form-select">
                                    <option value="LOW" {{ old('priority') == 'LOW' ? 'selected' : '' }}>Low</option>
                                    <option value="MEDIUM" {{ old('priority') == 'MEDIUM' ? 'selected' : '' }}>Medium
                                    </option>
                                    <option value="HIGH" {{ old('priority') == 'HIGH' ? 'selected' : '' }}>High</option>
                                </select>
                                @error('priority')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Start Date -->
                            <div class="col-md-6">
                                <label class="form-label">Start Date</label>
                                <input type="date" name="start_date" class="form-control"
                                    value="{{ old('start_date') }}">
                                @error('start_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- End Date -->
                            <div class="col-md-6">
                                <label class="form-label">End Date</label>
                                <input type="date" name="end_date" class="form-control"
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
