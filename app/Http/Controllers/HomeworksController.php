<?php

namespace App\Http\Controllers;

use App\Homework;

class HomeworksController extends Controller
{
    /**
     * Delete the current resource
     *
     * @param Homework $homework
     * @return App\Illuminate\HttpResponse
     */
    public function delete(Homework $homework)
    {
        $homework->delete();
        return response()->json(['message' => 'Actividad eliminada correctamente']);
    }
}
