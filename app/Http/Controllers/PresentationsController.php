<?php

namespace App\Http\Controllers;

use App\Presentation;
use Illuminate\Http\Request;

class PresentationsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a paginated listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Presentation::orderBy('name')->paginate(6);
    }

    /**
     * Display all list of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function presentations()
    {
        return Presentation::orderBy('name')->get();
    }

    /**
     * Render grades main view
     *
     * @return void
     */
    public function render()
    {
        return view('parameters.index');
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
        Presentation::create($attributes);
        return response()->json(['message' => 'Entregable creado correctamente'], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Presentation $presentation)
    {
        $attributes = request()->validate([
            'name' => 'required'
        ]);
        $presentation->update($attributes);
        return response()->json(['message' => 'Entregable actualizado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presentation $presentation)
    {
        $presentation->delete();
        return response()->json(['message' => 'Entregable eliminado correctamente']);
    }
}
