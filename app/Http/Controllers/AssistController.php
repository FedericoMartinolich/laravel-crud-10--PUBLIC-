<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assist;
use App\Models\Student;
use App\Models\Parameter;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateAssistRequest;
use App\Http\Requests\StoreAssistRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AssistController extends Controller
{
    public function show(Student $student) : View
    {
        $userId = auth()->id();
        $parameters = Parameter::where('user_id', $userId)->first();
        $attributes = $parameters->getAttributes();
        $promotion = $attributes['promotion'];
        $regular = $attributes['regular'];
        $free = $attributes['free'];
        $classes = $attributes['classes'];

        $studentAssists = $student->assists;//
        $numStudentAssists = count($studentAssists);
        $percentage = $numStudentAssists/$classes*100;

        $condition = '';
        //dd($numStudentAssists);
        if ($percentage>$promotion) {
            $condition = 'Promotion';
        } elseif ($percentage>$regular) {
            $condition = 'Regular';
        } elseif ($percentage>$free) {
            $condition = 'Free';
        } else {
            $condition = 'The student does not meet the minimum attendance requirements';
        }

        return view('students.assist', [
            'assists' => $studentAssists,
            'condition' => $condition
        ]);
    }

    public function menu() : View
    {
        return view('students.menuAssist');
    }

    public function search(Request $request)
    {
        $data = $request->validate([
            'dni' => 'required',
        ]);

        // Buscar el estudiante por el DNI usando Eloquent
        $student = Student::where('dni', $data['dni'])->with('assists')->first();

        if ($student) {
            // Redirige a la ruta 'students.show' pasando el estudiante encontrado
            return redirect()->route('students.show', $student->id);
        } else {
            // Si el estudiante no se encuentra, redirige con un mensaje de error
            return redirect()->back()->withErrors('Error: The student was not found');
        }
    }


    public function store(Request $request)
    {
        // Validacion
        $data = $request->validate([
            'id' => 'required|integer',
        ]);

        // Traer registro del estudiante seleccionado
        $student = DB::table('students')->where('id', $data['id'])->first();
        if (!$student) {
            return redirect()->back()->withErrors('Error: New Assist isn\'t added (the student was not found)');
        }

        // Fecha actual
        $today = Carbon::now()->format('y-m-d');
        
        $studentAssists = DB::table('assists')
            ->whereDate('assist', $today) // whereDate facilita la comparacion entre fechas
            ->where('student_id', $data['id'])
            ->exists(); // El exists devuelve true cuando encuentra un registro

        //dd($studentAssists);

        if (!$studentAssists) {
            DB::table('assists')->insert([
                'student_id' => $student->id,
                'assist' => now(),
            ]);

            return redirect()->route('students.index')
                ->withSuccess('New Assist is added successfully.');
        } else {
            return redirect()->route('students.index')
                ->withSuccess('This student has already had attendance recorded today');
        }
    }
}