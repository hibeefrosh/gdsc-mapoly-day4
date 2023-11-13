<!-- headmasterdashboard.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Headmaster Dashboard</h1>
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
        <i class="fas fa-plus"></i> Create Student
    </button>
    @if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Payment Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->payment_status == 1 ? 'Approved' : 'Pending' }}</td>
                <td>
                    <!-- Actions for Headmaster -->
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal-{{ $student->id }}">
                        <i class="fas fa-edit"></i> Edit
                    </a>

                    <!-- Delete Button -->
                    <a href="#" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $student->id }}').submit();">
                        <i class="fas fa-trash-alt"></i> Delete
                    </a>
                    <form id="delete-form-{{ $student->id }}" action="{{ route('headmaster.students.destroy', $student) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>

                    <a href="{{ route('headmaster.students.print-fee-payment', $student) }}" class="btn btn-success">
                        <i class="fas fa-print"></i> Print Fee Payment
                    </a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Create Student Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Create Student Form -->
                    <form action="{{ route('headmaster.students.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Student Modal -->
    @foreach($students as $student)
    <div class="modal fade" id="editModal-{{ $student->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $student->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Edit Student Form -->
                    <form action="{{ route('headmaster.students.update', $student->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $student->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="payment_status" class="form-label">Payment Status</label>
                            <select class="form-control" id="payment_status" name="payment_status">
                                <option value="0" selected>Not Approved</option>
                                <option value="1">Approved</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection