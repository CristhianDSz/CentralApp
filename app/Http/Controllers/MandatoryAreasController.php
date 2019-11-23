<?php

namespace App\Http\Controllers;

use App\MandatoryArea;

class MandatoryAreasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(MandatoryArea::class,'mandatory_area');
    }
    
    public function render()
    {
        return view('areas.index');
    }

    /**
     * List the mandatory areas of the aunthenticated user
     *
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return auth()->user()
        ->mandatoryAreas()
        ->with('subjects')
        ->orderBy('name')
        ->paginate(6);
    }
    /**
     * List the mandatory areas of the aunthenticated user
     *
     * @return Illuminate\Http\Response
     */
    public function mandatoryAreas()
    {
        return auth()->user()
        ->mandatoryAreas()
        ->with('subjects')
        ->orderBy('name')
        ->get();
        //return MandatoryArea::orderBy('name')->with('subjects')->get();
    }

    public function store()
    {
        $this->authorize('create',MandatoryArea::class);

        $attributes = request()->validate([
            'name' => 'required'
        ]);
        MandatoryArea::create($attributes);
        return response()->json(['message' => 'Área creada correctamente'], 201);
    }

    public function update(MandatoryArea $mandatoryArea)
    {
        $this->authorize('update', $mandatoryArea);

        $attributes = request()->validate([
            'name' => 'required'
        ]);
        $mandatoryArea->update($attributes);
        return response()->json(['message' => 'Área creada correctamente']);
    }

    public function destroy(MandatoryArea $mandatoryArea)
    {
        $this->authorize('delete', $mandatoryArea);

        $mandatoryArea->delete();
        return response()->json(['message' => 'Área eliminada correctamente']);
    }

}
