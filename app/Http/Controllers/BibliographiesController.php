<?php

namespace App\Http\Controllers;

use App\Bibliography;

class BibliographiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Save the incomming bibliography
     *
     * @return Illuminate\HttpResponse
     */
    public function store()
    {
        $attributes = request()->validate([
            'url' => 'required|min:3',
            'learning_section_id' => 'required|numeric',
        ]);
        $bibliography = Bibliography::create($attributes);
        return response()->json(['message' => 'Referencia bibliográfica creada correctamente','bibliography' => $bibliography],201);
    }

    /**
     * Delete the current resource
     *
     * @param Bibliography $bibliography
     * @return illuminate\HttpResponse
     */
    public function destroy(Bibliography $bibliography)
    {
        $bibliography->delete();
        return response()->json(['message' => 'Ref. bibliográfica eliminada correctamente']);
    }
}
