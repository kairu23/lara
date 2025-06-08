@extends('base')
@section('title', 'Student Lists')

<div>
    <!-- Display Status Message -->
    @if(session('success'))
    <div class="alert alert-success" id="success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger" id="danger">
        {{ session('error') }}
    </div>
    @endif

    <!-- Display Student Lists Table -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left;"><strong>Student Lists</strong></h4>
                        <button type="button" class="btn btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#studentListsModal">
                            Add New Student
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                <tr>
                                    <td>{{ $student->id }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->age }}</td>
                                    <td>
                                        <!-- Edit Button -->
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editStudentModal{{ $student->id }}">
                                            Edit
                                        </button>

                                        <!-- Delete Button -->
                                        <form action="{{ route('std.delete', $student->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Edit Student Modal -->
                                <div class="modal fade" id="editStudentModal{{ $student->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('std.update', $student->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Student</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Name</label>
                                                        <input type="text" class="form-control" name="stdName" value="{{ $student->name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Age</label>
                                                        <input type="number" class="form-control" name="stdAge" value="{{ $student->age }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add New Student Modal -->
    <div class="modal fade" id="studentListsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('std.create') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Student</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="stdName" value="{{ old('stdName') }}" placeholder="Enter Name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Age</label>
                            <input type="number" class="form-control" name="stdAge" value="{{ old('stdAge') }}" placeholder="Enter Age" min="1" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Student</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>