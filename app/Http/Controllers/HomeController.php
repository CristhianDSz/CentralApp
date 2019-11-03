<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Send to view home
     *
     * @return void
     */
    public function index()
    {
        return view('home.index');
    }
}
