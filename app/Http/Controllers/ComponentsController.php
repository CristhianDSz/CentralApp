<?php

namespace App\Http\Controllers;

use App\Component;

class ComponentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function render()
    {
        return view('components.index');
    }

    public function index()
    {
        return Component::orderBy('name')->with('mandatoryArea')->with('grades')->with('competences.indicators')->paginate(6);
    }

    public function components()
    {
        return Component::orderBy('name')->with('mandatoryArea')->with('grades')->with('competences.indicators')->get();
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

    public function destroy(Component $component)
    {
        $component->delete();
        return response()->json(['message' => 'Component eliminado correctamente']);
    }


}
