<?php

namespace App\Http\Controllers;

use App\Ova;
use App\School;
use Illuminate\Support\Facades\Storage;
use PDF;

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
        $idsAuthUser = auth()->user()->mandatoryAreas->pluck('id');
        return Ova::from('ovas as ovas')->orderBy('ovas.created_at')->whereIn('mandatory_area_id',$idsAuthUser)
            ->with('mandatoryArea')
            ->with('grade')
            ->with('class')
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
                    ->with('homeworks.presentation');
            }])
            ->paginate(6);
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

        $attributes['user_id'] = auth()->id();
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
        
        $attributes['user_id'] = auth()->id();

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

    /**
     * Display the pdf file for the resource
     *
     * @return void
     */
    public function pdf($id)
    {
        $school = School::first();
        $ova = Ova::with('learningSections')->findOrFail($id);
        //return view('ovas.pdf',compact('ova','school'));
        $pdf = PDF::loadView('ovas.pdf',compact('ova','school'));
        return $pdf->download('listado.pdf');
    }

    /**
     * Store/Update image for the resource
     *
     * @param int $id
     * @return void
     */
    public function storeImage($id)
    {
        $ova = Ova::findOrFail($id);

        request()->validate([
            'file' => 'sometimes|required|file|image'
        ]);

        if (request()->has('file')) {
            Storage::disk('s3')->delete($ova->image);
            $ova->update([
                'image' => request()->file->store('ovas', 's3')
            ]);
        }
       
        return response()->json(['message' => 'Archivo subido correctamente']);
    }
}
