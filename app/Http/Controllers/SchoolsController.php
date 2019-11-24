<?php

namespace App\Http\Controllers;

use App\School;
use Illuminate\Support\Facades\Storage;

class SchoolsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(School::class,'school');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $school = School::orderBy('name')->first();
        return view('schools.index', compact('school'));
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
            'name' => 'required',
            'location' => 'required',
            'address' => 'nullable',
            'phone' => 'required|max:10|min:6',
            'website' => 'nullable|string',
            'logo' => 'nullable||file|image'
        ]);

        $school = School::create($attributes);
        
        $this->storeLogo($school,'logo');
        return redirect()->back();
    }

    public function edit(School $school)
    {
        $this->authorize("update",$school);
        return view('schools.edit', compact('school'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(School $school)
    {
        $this->authorize("update",$school);

        $attributes = request()->validate([
            'name' => 'required',
            'location' => 'required',
            'address' => 'nullable',
            'phone' => 'required|max:10|min:6',
            'website' => 'nullable|string',
            'logo' => 'nullable|file|image'
        ]);

        $school->update($attributes);
        $this->storeLogo($school,'logo');

        return redirect()->route('schools.index');
    }

    private function storeLogo($school, $logo)
    {
        if (request()->has($logo)) {
            Storage::disk('s3')->delete($school->logo);
            $school->update([
                $logo => request()->$logo->store('uploads', 's3')
            ]);
        }
    }
}
