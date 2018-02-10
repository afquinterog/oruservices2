<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Branch;
use App\Models\ServiceType;
use App\Http\Requests\Branches\BasicRequest;

class BranchController extends Controller
{
    
    /**
     * Display the branches list 
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = allQueryFormat($request->filter);

        $branches = Branch::where('name', 'LIKE', $filter )->paginate(10);

        $request->flash();

        return view('branches.index', ['branches' => $branches ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    		$branch = new Branch;
        
        $branch->load("serviceType");

        $serviceTypes = ServiceType::list();

        return view('branches.new', ['serviceTypes' => $serviceTypes ]);
    }

    /**
     * Store branch information
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BasicRequest $request)
    {
        $branch = new Branch;

        $branch->saveOrUpdate( $request->all() );

        $request->session()->flash('status', __('messages.saved_ok'));

        return redirect()->action('BranchController@index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        
        $branch->load("serviceType");

        $serviceTypes = ServiceType::list();

        return view('branches.edit', ['branch' => $branch, 'serviceTypes' => $serviceTypes ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Branch::destroy( $id );

        request()->session()->flash('status', __('messages.deleted_ok'));

        return back()->withInput();

    }

}