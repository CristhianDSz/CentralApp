<?php

namespace App\Http\Controllers;

use App\Resource;

class ResourcesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Save the incomming resource
     *
     * @return Illuminate\HttpResponse
     */
    public function store()
    {
        $attributes = request()->validate([
            'url' => 'required|min:3',
            'learning_section_id' => 'required|numeric',
        ]);
        $resource = Resource::create($attributes);
        return response()->json(['message' => 'Recurso creado correctamente','resource' => $resource],201);
    }    
    /**
     * Delete the current resource
     *
     * @param Resource $resource
     * @return Illuminate\HttpResponse
     */
    public function destroy(Resource $resource)
    {
        $resource->delete();
        return response()->json(['message' => 'Recurso eliminado correctamente']);
    }
}
