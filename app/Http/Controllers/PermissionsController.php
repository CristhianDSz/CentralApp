<?php

namespace App\Http\Controllers;

use App\Permission;

class PermissionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * List the current resources
     *
     * @return void
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('permissions.index',compact('permissions'));
    }
}
