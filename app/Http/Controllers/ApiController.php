<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assist;
use App\Models\Student;
use Illuminate\View\View;

class ApiController extends Controller
{
    // public function conditionStudent(Student $student)
    // {
    //     $classes = 1;
    //     $studentAssists = $student->assists;
    //     $numAssist = count($studentAssists);
    //     $percentage = ($numAssist/$classes)*100;
    //     if ($percentage>80) {
    //         $condition = 'Promotion';
    //     } elseif ($percentage>60) {
    //         $condition = 'Regular';
    //     } else {
    //         $condition = 'Free';
    //     }
        
    //     return view('students.assist', [
    //         'condition' => $condition
    //     ]);
    // }
}
