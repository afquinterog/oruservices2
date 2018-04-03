<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Bouncer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin');
    }


    public function services()
    {
        return view('service-types');
    }

    public function checkPrivileges()
    {
        //Bouncer::allow('admin')->to('view-reports');
        Bouncer::allow('admin')->to('remove-roles');
    }
}
