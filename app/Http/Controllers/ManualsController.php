<?php

namespace App\Http\Controllers;

use App\Manual;
use Illuminate\Support\Facades\Storage;

class ManualsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->authorizeResource(Manual::class,"manual");
    }
    /**
     * Display list of current resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $manuals = Manual::all();
        return view('manuals.index', compact('manuals'));
    }

    /**
     * Display a create form of the current resource
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Manual::class);
        return view('manuals.create');
    }

    /**
     * Save the current resource
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->authorize('create',Manual::class);
        request()->validate([
            'name' => 'required|min:3',
            'file' => 'required|file'
        ]);

        if (request()->has('file')) {
            //Storage::disk('public')->delete($manual->name);
            Manual::create([
                'name' => request('name'),
                'file' => request()->file->store('manuals', 's3')
            ]);
        }

        return redirect()->route('manuals.index');
    }

    /**
     * Display an edit form of the current resource
     *
     * @param Manual $manual
     * @return \Illuminate\Http\Response
     */
    public function edit(Manual $manual)
    {
        $this->authorize('update', $manual);
        return view('manuals.edit',compact('manual'));
    }

    /**
     * Update the current resource
     *
     * @param Manual $manual
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Manual $manual)
    {
        $this->authorize('update', $manual);

        request()->validate([
            'name' => 'required|min:3',
            'file' => 'required|file'
        ]);

        if (request()->has('file')) {
            Storage::disk('s3')->delete($manual->file);
            $manual->update([
                'name' => request('name'),
                'file' => request()->file->store('manuals', 's3')
            ]);
        }

        return redirect()->route('manuals.index');
    }

    /**
     * Delete the current response
     *
     * @param Manual $manual
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Manual $manual)
    {
        $this->authorize('delete', $manual);

        Storage::disk('s3')->delete($manual->file);
        $manual->delete();
        return redirect()->route('manuals.index');
    }

}
