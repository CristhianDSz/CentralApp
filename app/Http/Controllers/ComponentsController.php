<?php

namespace App\Http\Controllers;

use App\Component;

class ComponentsController extends Controller
{
    public function render()
    {
        return view('components.index');
    }

    public function index()
    {
        return Component::orderBy('name')->with('mandatoryArea')->with('grades')->with('competences')->get();
    }

    public function store()
    {
        $attributes= request()->validate([
            'name' => 'required|min:3',
            'mandatory_area_id' => 'required|numeric',
            'grades' => ''
        ]);

        $component = Component::create($attributes);
        $component->grades()->attach($attributes['grades']);
        return response()->json(['message' => 'Componente creado correctamente'],201);
    }

    public function update(Component $component)
    {
        $attributes= request()->validate([
            'name' => 'required|min:3',
            'mandatory_area_id' => 'required|numeric',
            'grades' => ''
        ]);

        $component->update($attributes);
        $component->grades()->sync($attributes['grades']);
        return response()->json(['message' => 'Componente actualizado correctamente']);
    }


}
