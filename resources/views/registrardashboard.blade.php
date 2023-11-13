<!-- registrardashboard.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Dashboard</h1>
    @if(session('success'))
    <div>{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div>{{ session('error') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->payment_status == 1 ? 'Paid' : 'Not Paid' }}</td>
                <td>
                    <!-- Actions for Registrar -->
                    <a href="#" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#updateModal-{{ $student->id }}">
                        <i class="fas fa-edit"></i> Update
                    </a>
                    <a href="{{ route('registrar.print-fee-payment', $student->id) }}" class="btn btn-success"><i class="fas fa-print"></i> Print Fee Payment</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Update Student Modals -->
    @foreach($students as $student)
    <div class="modal fade" id="updateModal-{{ $student->id }}" tabindex="-1" aria-labelledby="updateModalLabel-{{ $student->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel-{{ $student->id }}">Update Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Update Student Form -->
                    <form action="{{ route('registrar.update', $student->id) }}" method="post">
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
                        <button type="submit" class="btn btn-primary">Update Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>
@endsection