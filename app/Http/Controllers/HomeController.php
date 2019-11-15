<?php

namespace App\Http\Controllers;

use App\Ova;
use App\SchoolClass;
use App\Subject;
use App\User;

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
        $ovas = Ova::orderBy('created_at','desc')->take('10')
            ->with('mandatoryArea:id,name')
            ->with('subject:id,name')
            ->with('grade:id,name')
            ->with('class:id,name')
            ->with('user:id,name,email')
            ->get();
        
        $countSubjects = Subject::count();
        $countOvas = Ova::count();
        $countUsers = User::count();
        $countClasses = SchoolClass::count();
       
        return view('home.index',
        compact('ovas','countOvas','countUsers','countSubjects','countClasses'));
    }
}
