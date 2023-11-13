<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,',
        ]);

        // Create a new student
        Student::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        // Redirect back to the headmaster dashboard
        return redirect()->route('headmaster.index')->with('success', 'Student created successfully.');
    }

    public function update(Request $request, Student $student)
    {
       
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'payment_status' => 'required|boolean',
        ]);

        $student->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'payment_status' =>  $validatedData['payment_status'],
        ]);

        return redirect()->route('headmaster.index')->with('success', 'Student updated successfully.');
    }
    public function updateStudentRecord(Request $request, $id)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
        ]);

       
        $student = Student::find($id);

       
        if (!$student) {
            return redirect()->route('registrar.index')->with('error', 'Student not found.');
        }

        
        $student->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        return redirect()->route('registrar.index')->with('success', 'Student updated successfully.');
    }


    public function printFeePayment($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return redirect()->route('registrar.index')->with('error', 'Student not found');
        }
        return view('print-fee-payment', compact('student'));
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('headmaster.index')->with('success', 'Student deleted successfully');
    }

    public function headmasterprintFeePayment(Student $student)
    {

        if (!$student) {
            return redirect()->route('registrar.index')->with('error', 'Student not found');
        }
        return view('headmaster-print-fee-payment', compact('student'));
    }

}
