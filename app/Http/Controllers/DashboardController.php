<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceType;

use App\Models\Customer;

class DashboardController extends Controller
{
    
    /**
     * Display the dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $serviceTypes = ServiceType::all();

        return view('dashboard', ['serviceTypes' => $serviceTypes ]);
    }
}
