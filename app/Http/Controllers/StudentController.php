<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Assist;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Parameter;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Session;
use App\Exports\StudentExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\LogCrud;

class StudentController extends Controller
{

    public function index()
    {
        $academic_year = session('academic_year', 'All');
        $group = session('group', 'All');
    
        $query = Student::query();
    
        if ($academic_year != 'All') {
            $query->where('academic_year', $academic_year);
        }
    
        if ($group != 'All') {
            $query->where('group', $group);
        }
    
        $students = $query->paginate(10);
    
        return view('students.index', compact('students'));
    }    


    public function create() : View
    {
        return view('students.create');
    }

    public function store(StoreStudentRequest $request) : RedirectResponse
    {
        $data = $request->except('_token');

        $birth = $request->input("birth");
        $now = now();
        $age = $now->diffInYears($birth);

        if ($age < 18) {
            return redirect()->back()->withInput()->withErrors(['birth' => 'The student is not of legal age']);
        } else {
            
            try {
                Student::create($data);
        
                LogCrud::create([
                    'user_id' => auth()->user()->id,
                    'action' => 'store',
                    'ip' => $request->ip(),
                    'browser' => $request->header('User-Agent'),
                    'date' => now(),
                ]);
        
                return redirect()->route('students.index')->withSuccess('New Student is added successfully.');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->withErrors(['store' => 'An error occurred while adding the new student.']);
            }
        }
    }

    public function show(Student $student) : View
    {
        $student->load('assists');

        $userId = auth()->id();
        $parameters = Parameter::where('user_id', $userId)->first();
        $attributes = $parameters->getAttributes();
        $promotion = $attributes['promotion'];
        $regular = $attributes['regular'];
        $free = $attributes['free'];
        $classes = $attributes['classes'];

        $numStudentAssists = $student->assists->count();
        $percentage = ($numStudentAssists / $classes) * 100;

        $condition = '';
        if ($percentage > $promotion) {
            $condition = 'Promotion';
        } elseif ($percentage > $regular) {
            $condition = 'Regular';
        } elseif ($percentage > $free) {
            $condition = 'Free';
        } else {
            $condition = 'The student does not meet the minimum attendance requirements';
        }

        return view('students.show', [
            'student' => $student,
            'condition' => $condition,
        ]);
    }   

    public function downloadPDF(Student $student) 
    {
        /* dd($student); */
        $student->load('assists');
    
        $userId = auth()->id();
        $parameters = Parameter::where('user_id', $userId)->first();
        $attributes = $parameters->getAttributes();
        $promotion = $attributes['promotion'];
        $regular = $attributes['regular'];
        $free = $attributes['free'];
        $classes = $attributes['classes'];
    
        $studentAssists = $student->assists;
        $numStudentAssists = $studentAssists->count();
        $percentage = ($numStudentAssists / $classes) * 100;
    
        $condition = '';
        if ($percentage > $promotion) {
            $condition = 'Promotion';
        } elseif ($percentage > $regular) {
            $condition = 'Regular';
        } elseif ($percentage > $free) {
            $condition = 'Free';
        } else {
            $condition = 'The student does not meet the minimum attendance requirements';
        }
    
        $pdf = Pdf::loadView('students.pdf', [
            'student' => $student,
            'condition' => $condition,
        ]);
    
        return $pdf->download('student_info.pdf');
    }

    public function downloadExcel($id)
    {
        $student = Student::with('assists')->findOrFail($id);
        
        $userId = auth()->id();
        $parameters = Parameter::where('user_id', $userId)->first();
        $attributes = $parameters->getAttributes();
        $promotion = $attributes['promotion'];
        $regular = $attributes['regular'];
        $free = $attributes['free'];
        $classes = $attributes['classes'];

        $studentAssists = $student->assists;
        $numStudentAssists = $studentAssists->count();
        $percentage = ($numStudentAssists / $classes) * 100;

        $condition = '';
        if ($percentage > $promotion) {
            $condition = 'Promotion';
        } elseif ($percentage > $regular) {
            $condition = 'Regular';
        } elseif ($percentage > $free) {
            $condition = 'Free';
        } else {
            $condition = 'The student does not meet the minimum attendance requirements';
        }

        return Excel::download(new StudentExport($student, $condition), 'student.xlsx');
    }

    public function edit(Student $student) : View
    {
        return view('students.edit', [
            'student' => $student
        ]);
    }

    public function update(UpdateStudentRequest $request, Student $student) : RedirectResponse
    {
        $request->validate([
            'dni' => 'required|string|unique:students,dni,' . $student->id,
            'name' => 'required|string',
            'surname' => 'required|string',
            'birth' => 'required|date',
            'group' => 'required|string',
            'academic_year' => 'required|integer',
        ]);
    
        $data = $request->except('_token', '_method');
    
        $birth = $request->input("birth");
        $now = now();
        $age = $now->diffInYears($birth);
    
        if ($age < 18) {
            return redirect()->back()->withInput()->withErrors(['birth' => 'The student is not of legal age']);
        } else {

            try {
                $student->update($data);
        
                LogCrud::create([
                    'user_id' => auth()->user()->id,
                    'action' => 'update',
                    'ip' => $request->ip(),
                    'browser' => $request->header('User-Agent'),
                    'date' => now(),
                ]);
        
                return redirect()->back()->withSuccess('Student is updated successfully.');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->withErrors(['update' => 'An error occurred while updating the student.']);
            }
        }
    }
    
    public function destroy(Student $student) : RedirectResponse
    {
        $ip = empty($_SERVER["REMOTE_ADDR"]) ? "Desconocida" : $_SERVER["REMOTE_ADDR"];
        $browser = empty($_SERVER['HTTP_USER_AGENT']) ? "Desconocido" : $_SERVER['HTTP_USER_AGENT'];

        LogCrud::create([
            'user_id' => auth()->user()->id,
            'action' => 'destroy',
            'ip' => $ip,
            'browser' => $browser,
            'date' => now(),
        ]);

        $student->delete();
        return redirect()->route('students.index')
                ->withSuccess('Student is deleted successfully.');
    }

    public function addAssist(Student $student) : View
    {
        return view('students.addAssist', [
            'student' => $student
        ]);
    }

    public function __construct()
    {
        $this->middleware('log');
    }

    public function birthday()
    {
        $today = Carbon::now()->format('m-d');
        $birthdays = DB::table('students')->whereRaw("DATE_FORMAT(birth, '%m %d') = '{$today}'")->get(['name', 'surname']);

        if ($birthdays->isNotEmpty()) {
            return view('students.index', [
                'birthdays' => $birthdays
            ]);
        }
    }

    public function filter(Request $request)
    {   
        $data = $request->validate([
            'academic_year' => 'required',
            'group' => 'required',
        ]);
    
        // Guardar los filtros en la sesión
        session([
            'academic_year' => $data['academic_year'],
            'group' => $data['group']
        ]);
    
        return redirect()->route('students.index');
    }
    
}