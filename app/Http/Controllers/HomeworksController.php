<?php

namespace App\Http\Controllers;

use App\Homework;

class HomeworksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Store the incomming resource
     *
     * @return Illuminate\HttpResponse
     */
    public function store()
    {
        $attributes = request()->validate([
            'content' => 'required|min:3',
            'presentation' => 'required|min:3',
            'learning_section_id' => 'required|numeric'
        ]);
        $homework = Homework::create($attributes);
        return response()->json(['message' => 'Actividad creada correctamente','homework' => $homework],201);
    }
    /**
     * Delete the current resource
     *
     * @param Homework $homework
     * @return App\Illuminate\HttpResponse
     */
    public function destroy(Homework $homework)
    {
        $homework->delete();
        return response()->json(['message' => 'Actividad eliminada correctamente']);
    }
}
