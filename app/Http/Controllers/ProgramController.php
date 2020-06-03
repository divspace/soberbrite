<?php

namespace App\Http\Controllers;

use App\Database\Models\Program;
use Illuminate\View\View;

class ProgramController extends Controller
{
    public function index(): View
    {
        return view('programs.show')->with([
            'programs' => Program::orderBy('name')->get(),
        ]);
    }

    public function show(Program $program): Program
    {
        return $program;
    }
}
