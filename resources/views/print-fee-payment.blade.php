@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Fee Payment Details</h1>
        </div>
        <div class="card-body">
            <div>
                <p><strong>Name:</strong> {{ $student->name }}</p>
                <p><strong>Email:</strong> {{ $student->email }}</p>
                <p><strong>Payment Status:</strong> {{ $student->payment_status ? 'Paid' : 'Not Paid' }}</p>
            </div>

            @if($student->payment_status)
            <button class="btn btn-success" onclick="window.print()">Print Fee Payment</button>
            @else
            <p class="text-danger">Payment not confirmed. Cannot print fee payment.</p>
            @endif

            <a href="{{ route('registrar.index') }}" class="btn btn-primary">Back to Dashboard</a>
        </div>
    </div>
</div>
@endsection