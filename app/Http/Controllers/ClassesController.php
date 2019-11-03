<?php

namespace App\Http\Controllers;

use App\SchoolClass;

class ClassesController extends Controller
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
        return SchoolClass::orderBy('name')->with('grade')->get();
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
            'name' => 'required',
            'grade_id' => 'required|numeric'
        ]);
        SchoolClass::create($attributes);
        return response()->json(['message' => 'Grado creado correctamente'], 201);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $attributes = request()->validate([
            'name' => 'required',
            'grade_id' => 'required|numeric'
        ]);
        $schoolClass = SchoolClass::findOrFail($id);
        $schoolClass->update($attributes);
        return response()->json(['message' => 'Grado actualizado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schoolClass = SchoolClass::findOrFail($id);
        $schoolClass->delete();
        return response()->json(['message' => 'Grado eliminado correctamente']);
    }
}
