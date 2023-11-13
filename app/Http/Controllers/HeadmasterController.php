<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class HeadmasterController extends Controller
{
    public function index()
    {
        // Fetch all students from the database
        $students = Student::all();

        // Pass the students data to the view
        return view('headmasterdashboard', ['students' => $students]);
    }
    
}
