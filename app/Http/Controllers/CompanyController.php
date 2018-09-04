<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\Companies\CompanyRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = allQueryFormat( $request->filter );

        $companies = Company::where('name', 'LIKE', $filter )->paginate(10);


        $request->flash();

        return view('companies.index', ['companies' => $companies ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        
        $company = new Company;

        $company->saveOrUpdate( $request->all() );

        $request->session()->flash('status', __('messages.saved_ok'));

        return back()->withInput();
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);

        return view('companies.edit', ['company' => $company  ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update($id, CompanyRequest $request)
    {
        //

        $company = new Company;
        
        $company->saveOrUpdate( array_merge($request->all(), ['id' => $id]) );

        $request->session()->flash('status', __('messages.saved_ok'));

        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Company::destroy($id);
        return back()->withInput();
    }
}
