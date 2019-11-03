<?php

namespace App\Http\Controllers;

use App\Grade;

class GradesController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Grade::orderBy('name')->with('classes')->get();
    }

    /**
     * Render grades main view
     *
     * @return void
     */
    public function render()
    {
        return view('grades.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required'
        ]);
        Grade::create($attributes);
        return response()->json(['message' => 'Grado creado correctamente'], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Grade $grade)
    {
        $attributes = request()->validate([
            'name' => 'required'
        ]);
        $grade->update($attributes);
        return response()->json(['message' => 'Grado actualizado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        $grade->delete();
        return response()->json(['message' => 'Grado eliminado correctamente']);
    }
}
