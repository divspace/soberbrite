<?php

namespace App\Http\Controllers;

use App\Database\Models\Program;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        return view('programs.show')->with([
            'programs' => Program::orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Program $program): Program
    {
        return $program;
    }

    public function edit(Program $program)
    {
        //
    }

    public function update(Request $request, Program $program)
    {
        //
    }

    public function destroy(Program $program)
    {
        //
    }
}
