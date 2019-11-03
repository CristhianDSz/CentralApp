<?php

namespace App\Http\Controllers;

use App\Ova;

class OvasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display the resource view
     *
     * @return \Illuminate\Support\Facades\View
     */
    public function render()
    {
        return view('ovas.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ova::orderBy('created_at')
            ->with('grade')
            ->with('class')
            ->with('mandatoryArea')
            ->with('subject')
            ->with('user')
            ->with(['learningSections' => function ($query) {
                $query
                    ->with('ova')
                    ->with('components.competences.indicators')
                    ->with('competences.indicators')
                    ->with('indicators')
                    ->with('resources')
                    ->with('bibliographies')
                    ->with('homeworks');
            }])
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
            'period' => 'required|numeric',
            'theme' => 'required|min:3',
            'grade_id' => 'required|numeric',
            'class_id' => 'required|numeric',
            'mandatory_area_id' => 'required|numeric',
            'subject_id' => 'required|numeric',
        ]);

        //Assign ova code
        $code = 'TEST';
        //$code = Ova::buildCodeWith($attributes['grade_id], $attributes['mandatory_area_id]);

        $attributes['user_id'] = 1;
        $attributes['code'] = $code;

        Ova::create($attributes);

        return response()->json(['message' => 'Ova creada correctamente'],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ova $ova)
    {
        if ($ova) {
            return response()->json(['ova' => $ova], 200);
        }
        return response()->json(['message' => 'La Ova no existe'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Ova $ova)
    {
        $attributes = request()->validate([
            'period' => 'required|numeric',
            'theme' => 'required|min:3',
            'grade_id' => 'required|numeric',
            'class_id' => 'required|numeric',
            'mandatory_area_id' => 'required|numeric',
            'subject_id' => 'required|numeric',
            'user_id' => 'required|numeric'
        ]);
        
        //$attributes['user_id'] = auth()->id();

        $ova->update($attributes);

        return response()->json(['message' => 'Ova actualizada correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ova $ova)
    {
        $ova->delete();

        return response()->json(['message' => 'Ova eliminada correctamente']);
    }

    /**
     * Display the specified resource components
     *
     * @param Ova $ova
     * @return \Illuminate\Http\Response
     */
    public function components(Ova $ova)
    {
        return $ova->components()->with('competences.indicators')->get();
    }
}
