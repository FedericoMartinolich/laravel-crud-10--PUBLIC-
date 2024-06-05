<?php

namespace App\Http\Controllers;

use App\Models\LogCrud;
use App\Http\Requests\StoreLogCrudRequest;
use App\Http\Requests\UpdateLogCrudRequest;
use Illuminate\Support\Facades\DB;

class LogCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function storeCreate(StoreLogCrudRequest $request)
    {
        //
    }

    public function storeUpdate(StoreLogCrudRequest $request)
    {
        //
    }

    public function storeDelete(StoreLogCrudRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $role = auth()->user()->role;
            if ($role == 'admin') {
                $logsCrud = LogCrud::get();

            return view('students.logCrud', [
                'logsCrud' => $logsCrud
            ]);
        } else {
            return redirect()->back()->withErrors(['You are not allowed to see this']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LogCrud $logCrud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLogCrudRequest $request, LogCrud $logCrud)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LogCrud $logCrud)
    {
        //
    }
}
