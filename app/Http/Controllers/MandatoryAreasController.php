<?php

namespace App\Http\Controllers;

use App\MandatoryArea;

class MandatoryAreasController extends Controller
{
    public function render()
    {
        return view('areas.index');
    }

    public function index()
    {
        return MandatoryArea::orderBy('name')->get();
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required'
        ]);
        MandatoryArea::create($attributes);
        return response()->json(['message' => 'Área creada correctamente'], 201);
    }

    public function update(MandatoryArea $mandatoryArea)
    {
        $attributes = request()->validate([
            'name' => 'required'
        ]);
        $mandatoryArea->update($attributes);
        return response()->json(['message' => 'Área creada correctamente']);
    }

    public function destroy(MandatoryArea $mandatoryArea)
    {
        $mandatoryArea->delete();
        return response()->json(['message' => 'Área eliminada correctamente']);
    }
}
