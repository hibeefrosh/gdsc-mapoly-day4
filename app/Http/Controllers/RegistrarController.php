<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
class RegistrarController extends Controller
{
    public function index()
    {
        $students = Student::all();

        return view('registrardashboard', compact('students'));
    }
}
