<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Attribute;
use App\Models\ServiceType;

class AttributeController extends Controller
{
    
    /**
     * Display the attribute list 
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = addQueryToString($request->filter);
        $attributes = Attribute::where('name', 'LIKE', $filter )->paginate(10);
        $request->flash();
        return view('attributes.index', ['attributes' => $attributes ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('attributes.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Store attibute basic information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeBasic(BasicRequest $request)
    {
        
        $attribute = new Attribute;

        $attribute->saveOrUpdate( $request->all() );

        $request->session()->flash('status', __('messages.saved_ok'));

        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
    * Move the attribute order up
    *
    * @param  int  $attribute
    * @return \Illuminate\Http\Response
    */
    public function orderUp(Attribute $attribute, ServiceType $serviceType)
    {
        $attribute->orderUp( $serviceType );

        request()->session()->flash('status', __('messages.saved_ok'));

        request()->session()->flash('tab', "attributes" );

        return back()->withInput();
    }

    /**
    * Move the attribute order down
    *
    * @param  int  $attribute
    * @return \Illuminate\Http\Response
    */
    public function orderDown(Attribute $attribute, ServiceType $serviceType)
    {
        $attribute->orderDown( $serviceType );

        request()->session()->flash('status', __('messages.saved_ok'));

        request()->session()->flash('tab', "attributes" );

        return back()->withInput();
    }
}
