<?php

namespace App\Http\Controllers;

use App\Competence;
use Illuminate\Http\Request;

class CompetencesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Competence::orderBy('name')->with('component')->get();
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
            'component_id' => 'required|numeric'
        ]);

        Competence::create($attributes);
        return response()->json(['message' => 'Competencia creada correctamente'],201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Competence $competence)
    {
        $attributes = request()->validate([
            'name' => 'required',
            'component_id' => 'required|numeric'
        ]);

        $competence->update($attributes);
        return response()->json(['message' => 'Competencia actualizada correctamente'],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competence $competence)
    {
        $competence->delete();
        return response()->json(['message' => 'Competencia eliminada correctamente'],201);
    }
}
