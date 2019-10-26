<?php

namespace App\Http\Controllers;

use App\Indicator;

class IndicatorsController extends Controller
{
    public function index()
    {
        return Indicator::orderBy('name')->get();
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required',
            'competence_id' => 'required|numeric'
        ]);

        Indicator::create($attributes);
        return response()->json(['message' => 'Indicador creado correctamente'],201);
    }

    public function update(Indicator $indicator)
    {
        $attributes = request()->validate([
            'name' => 'required',
            'competence_id' => 'required|numeric'
        ]);

        $indicator->update($attributes);
        return response()->json(['message' => 'Indicador actualizado correctamente']);
    }

    public function destroy(Indicator $indicator)
    {
        $indicator->delete($indicator);
        return response()->json(['message' => 'Indicador eliminado correctamente']);
    }
}
