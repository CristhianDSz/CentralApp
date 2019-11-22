<?php

namespace App\Http\Controllers;

use App\Manual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManualsController extends Controller
{
    public function index()
    {
        $manual = Manual::first();
        return view('manuals.index', compact('manual'));
    }

    public function store()
    {
        request()->validate([
            'name' => 'required|min:3',
            'file' => 'required|file'
        ]);

        if (request()->has('file')) {
            //Storage::disk('public')->delete($manual->name);
            Manual::create([
                'name' => request('name'),
                'file' => request()->file->store('manuals', 'public')
            ]);
        }

        return redirect()->route('manuals.index');
    }

    public function edit(Manual $manual)
    {
        return view('manuals.edit',compact('manual'));
    }

    public function update(Manual $manual)
    {
        request()->validate([
            'name' => 'required|min:3',
            'file' => 'required|file'
        ]);

        if (request()->has('file')) {
            Storage::disk('public')->delete($manual->file);
            $manual->update([
                'name' => request('name'),
                'file' => request()->file->store('manuals', 'public')
            ]);
        }

        return redirect()->route('manuals.index');
    }

}
