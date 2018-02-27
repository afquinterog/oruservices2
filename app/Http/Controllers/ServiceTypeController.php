<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\ServiceType;
use App\Models\Attribute;
use App\Models\Task;
use App\Models\Branch;
use App\Http\Requests\ServiceTypes\BasicRequest;


class ServiceTypeController extends Controller
{
    /**
     * Display the service type list 
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = allQueryFormat( $request->filter );

        $serviceTypes = ServiceType::where('name', 'LIKE', $filter )->paginate(10);

        $request->flash();
        
        return view('servicetypes.index', ['serviceTypes' => $serviceTypes ]);
    }

    /**
     * Show the form for creating a new service type
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('servicetypes.new');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceType $serviceType)
    {
        $serviceType->load("attributes.attributeType");

        $attributes = Attribute::list();

        $serviceType->load("branches");   

        $branches = Branch::list();

        return view('servicetypes.edit', ['serviceType' => $serviceType, 'attributes' => $attributes, 'branches' => $branches ]);
    }

    /**
     * Store service type basic information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeBasic(BasicRequest $request)
    {
        
        $serviceType = new ServiceType;

        $serviceType->saveOrUpdate( $request->all() );

        $request->session()->flash('status', __('messages.saved_ok'));

        return back()->withInput();
    }

    /**
     * Store an attribute linked with the service type
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAttribute(Request $request)
    {
        
        $serviceType = ServiceType::find( $request->service );

        $order = $serviceType->nextAttributeOrder();

        $serviceType->attributes()->attach( $request->attribute, ['order' => $order ] );

        request()->session()->flash('status', __('messages.saved_ok'));

        request()->session()->flash( 'tab', "attributes" );

        return redirect()->route('service-type-edit', [ 'serviceType' => $serviceType->id ]);
    }

    /**
     * Store a task linked with the service type
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTask(Request $request)
    {
        //dd($request);
        $serviceType = ServiceType::find($request->service);
        
        $task = new Task;

        $task->order = $serviceType->nextTaskOrder();

        $task->fill( $request->all() );

        $serviceType->tasks()->save( $task );
        
        request()->session()->flash('status', __('messages.saved_ok'));

        request()->session()->flash('tab', 'tasks' );

        return redirect()->route('service-type-edit', [ 'serviceType' => $serviceType->id ]);
    }

    /**
     * Store an branch linked with the service type
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeBranch(Request $request)
    {
        
        $serviceType = ServiceType::find( $request->service );

        $order = $serviceType->nextBranchOrder();

        $serviceType->branches()->attach( $request->branch, ['order' => $order ] );

        request()->session()->flash('status', __('messages.saved_ok'));

        request()->session()->flash( 'tab', "branches" );

        return redirect()->route('service-type-edit', [ 'serviceType' => $serviceType->id ]);
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
        ServiceType::destroy( $id );

        request()->session()->flash('status', __('messages.deleted_ok'));

        return back()->withInput();

    }
    
}
