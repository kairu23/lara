@extends('base')
@section('title', 'Student Lists')

<style>
    body {
        background: linear-gradient(to right, #8b0000, #ff3333);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .container {
        max-width: 800px;
    }
    .modal-dialog {
        display: flex;
        justify-content: center;
    }
</style>

<div class="container">
    <!-- Display Status Message -->
    @if(session('success'))
    <div class="alert alert-success" id="success">
        {{ Session::get('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger" id="danger">
        {{ Session::get('error') }}
    </div>
    @endif
    
    <!-- Display Student Lists Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4><strong>Students List</strong></h4>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#studentListsModal">
                Add New Student
            </button>
        </div>
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->age }}</td>
                        <td>
                            <form action="{{ route('std.delete', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?');" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editStudentModal{{ $student->id }}">Edit</button>
                        </td>
                    </tr>

                    <!-- Edit Student Modal -->
                    <div class="modal fade" id="editStudentModal{{ $student->id }}" tabindex="-1" aria-labelledby="editStudentModalLabel{{ $student->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <form action="{{ route('std.update', $student->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="editStudentModalLabel{{ $student->id }}">Edit Student</h1>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="editStdName{{ $student->id }}" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="editStdName{{ $student->id }}" name="stdName" value="{{ $student->name }}" placeholder="Enter Name">
                                        </div>

                                        <div class="mb-3">
                                            <label for="editStdAge{{ $student->id }}" class="form-label">Age</label>
                                            <input type="text" class="form-control" id="editStdAge{{ $student->id }}" name="stdAge" value="{{ $student->age }}" placeholder="Enter Age">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
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

<!-- Add Student Modal -->
<div class="modal fade" id="studentListsModal" tabindex="-1" aria-labelledby="studentListsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('std.create') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="studentListsModalLabel">Add New Student</h1>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="stdName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="stdName" name="stdName" value="{{ old('stdName') }}" placeholder="Enter Name">
                    </div>

                    <div class="mb-3">
                        <label for="stdAge" class="form-label">Age</label>
                        <input type="text" class="form-control" id="stdAge" name="stdAge" value="{{ old('stdAge') }}" placeholder="Enter Age">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>