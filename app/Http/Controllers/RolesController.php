<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Role::class,"role");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Role::class);

        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->authorize('create', Role::class);

        $attributes = request()->validate([
            'name' => 'required|string|min:3',
        ]);
        $extraAttributes = request()->validate([
            'permissions' => 'required|array'
        ]);

        $role = Role::create($attributes);
        $role->permissions()->attach(request('permissions'));

        return redirect()->route('roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('update', $role);

        $permissions = Permission::all();
        return view('roles.edit', compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Role $role)
    {
        $this->authorize('update', $role);

        $attributes = request()->validate([
            'name' => 'required|string|min:3',
        ]);
        $extraAttributes = request()->validate([
            'permissions' => 'required|array'
        ]);

        $role->update($attributes);
        $role->permissions()->sync(request('permissions'));

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);

        $role->delete();
        return redirect()->back();
    }
}
