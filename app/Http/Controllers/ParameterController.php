<?php

namespace App\Http\Controllers;

use App\Models\Parameter;
use App\Http\Requests\StoreParameterRequest;
use App\Http\Requests\UpdateParameterRequest;
use App\Models\Student;
use App\Models\User;
use App\Models\Assist;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();
        //dd($userId);
        $parameter = Parameter::where('user_id', $userId)->first();
        
        return view('profile.parameters', [
            'parameter' => $parameter
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreParameterRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Parameter $parameter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Parameter $parameter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParameterRequest $request, Parameter $parameter)
    {
        //dd($request);
        $request->validate([
            'classes' => 'required|integer',
            'free' => 'required|integer',
            'regular' => 'required|integer',
            'promotion' => 'required|integer',
        ]);

        $data = $request->except('_token');
        $parameter->update($data);
        return redirect()->back()
                ->withSuccess('Parameters is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parameter $parameter)
    {
        //
    }
}
