<?php

namespace App\Http\Controllers;

use App\LearningSection;

class LearningSectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LearningSection::orderBy('title')
        ->with('components')
        ->with('competences')
        ->with('indicators')
        ->get();
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
            'title' => 'required|min:3',
            'start_date' => 'required',
            'end_date' => 'required',
            'context' => 'required|min:3',
            'ova_id' => 'required|numeric',
        ]);

        $extraAttributes = request()->validate([
            'components' => 'required|array',
            'competences' => 'required|array',
            'indicators' => 'required|array',
            'resources' => 'present|array',
            'bibliographies' => 'present|array',
            'homeworks' => 'present|array'
        ]);

        $learningSection = LearningSection::create($attributes);
        $learningSection->components()->attach($extraAttributes['components']);
        $learningSection->competences()->attach($extraAttributes['competences']);
        $learningSection->indicators()->attach($extraAttributes['indicators']);

        $learningSection->addManyResources($extraAttributes['resources']);
        $learningSection->addManyBibliographies($extraAttributes['bibliographies']);
        $learningSection->addManyHomeworks($extraAttributes['homeworks']);

        return response()->json(['message' => 'Unidad de aprendizaje creada correctamente'],201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $learningSection = LearningSection::findOrFail($id);
        
        $attributes = request()->validate([
            'title' => 'required|min:3',
            'start_date' => 'required',
            'end_date' => 'required',
            'context' => 'required|min:3',
            'ova_id' => 'required|numeric',
        ]);

        $extraAttributes = request()->validate([
            'components' => 'required|array',
            'competences' => 'required|array',
            'indicators' => 'required|array',
            'resources' => 'present|array',
            'bibliographies' => 'present|array',
            'homeworks' => 'present|array',
        ]);

        $learningSection->update($attributes);
        $learningSection->components()->sync($extraAttributes['components']);
        $learningSection->competences()->sync($extraAttributes['competences']);
        $learningSection->indicators()->sync($extraAttributes['indicators']);

        $learningSection->updateManyResources($extraAttributes['resources']);
        $learningSection->updateManyBibliographies($extraAttributes['bibliographies']);
        $learningSection->updateManyHomeworks($extraAttributes['homeworks']);

        return response()->json(['message' => 'Unidad de aprendizaje actualizada correctamente']);   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(LearningSection $learningSection)
    {
        $learningSection->delete();

        return response()->json(['message' => 'Unidad de aprendizaje eliminada correctamente']);  
    }
}
