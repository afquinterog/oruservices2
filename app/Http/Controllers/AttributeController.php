<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Attribute;
use App\Models\AttributeType;
use App\Models\ServiceType;
use App\Http\Requests\Attributes\BasicRequest;

class AttributeController extends Controller
{
    
    /**
     * Display the attribute list 
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = allQueryFormat($request->filter);

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
        $attribute = new Attribute;
        
        $attribute->load("attributeType");

        $attributeTypes = AttributeType::list();

        return view('attributes.new', ['attributeTypes' => $attributeTypes ]);
    }

    /**
     * Store attribute information
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attribute = new Attribute;

        $attribute->saveOrUpdate( $request->all() );

        $request->session()->flash('status', __('messages.saved_ok'));

        return redirect()->action('AttributeController@index');
    }

    /**
     * Store attibute basic information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeBasic(BasicRequest $request)
    {
        
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
    public function edit(Attribute $attribute)
    {

        $attribute->load("attributeType");

        $attributeTypes = AttributeType::list();

        return view('attributes.edit', ['attribute' => $attribute, 'attributeTypes' => $attributeTypes ]);
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
        Attribute::destroy( $id );

        request()->session()->flash('status', __('messages.deleted_ok'));

        return back()->withInput();

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
