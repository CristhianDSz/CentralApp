<?php

namespace App\Http\Controllers;

use App\Subject;

class SubjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return Subject::orderBy('name')->with('mandatoryArea')->get();
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required',
            'mandatory_area_id' => 'required|numeric'
        ]);
        Subject::create($attributes);
        return response()->json(['message' => 'Asignatura creada correctamente'], 201);
    }

    public function update(Subject $subject)
    {
        $attributes = request()->validate([
            'name' => 'required',
            'mandatory_area_id' => 'required|numeric'
        ]);
        $subject->update($attributes);
        return response()->json(['message' => 'Asignatura creada correctamente']);
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return response()->json(['message' => 'Asignatura eliminada correctamente']);
    }
}
