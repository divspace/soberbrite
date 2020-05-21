<?php

namespace App\Http\Controllers;

use App\Database\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        $programs = Program::orderBy('name')->get();

        return view('programs.show', compact('programs'));
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
