<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Facades\App\Models\Service as ServiceFacade;
use App\Models\ServiceType;
use Facades\App\Models\ServiceStatus;

use App\Http\Requests\Services\ServiceRequest;
use Facades\App\Models\ServiceWorkflow;


class ServiceController extends Controller
{
 
    /**
     * Display the service list
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $services = Service::list( $request->all() );
        $request->flash();  
        return view('services.index', ['services' => $services ]);
    }

    /**
    * Show the form for creating a new service
    *
    * @return \Illuminate\Http\Response
    */
    public function create(Request $request, ServiceType $serviceType)
    {
    	//$serviceType = ServiceType::find( $serviceType );
        return view('services.new', [ 'serviceType' => $serviceType] );
    }


    /**
    * Show the form to edit an attribute
    *
    * @return \Illuminate\Http\Response
    */
    public function edit(Request $request, Service $service)
    {
        ServiceFacade::getAdditionalData($service);

        $audits = $service->audits;

        $statuses = ServiceStatus::all();

        return view('services.edit', compact('service','statuses') );
    }


    public function redirectCreateForm(Request $request)
    {
      return redirect()->route('create-service', ['serviceType' => $request->service_type_id]);
    }


    /**
    * Store service information.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(ServiceRequest $request)
    {

        $service = ServiceFacade::saveOrUpdate( $request->except(['filter']) );

        $request->session()->flash('status', __('messages.service_saved_ok', ['service' => $service->id ] ) );

        return back()->withInput();

        //print_r($request->all());
        //exit;
        //return view('dashboard');
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
    * Update service information.
    *
    * @param  \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function update(ServiceRequest $request, $id)
    {
        
        
        $service = ServiceFacade::saveOrUpdate($request->except('filter'));


        $request->session()->flash('status', __('messages.service_saved_ok', ['service' => $service->id ] ) );
        
        return back()->withInput();
        

         

        // if( isset($request->data) && $request->data  != "") {
        //     $request->merge(['data' => json_encode($request->data) ]);

        //     //Save service information
        //     $service = $service->saveOrUpdate( $request->except(['time', 'filter']) );

        //     $request->session()->flash('status', __('messages.service_saved_ok', ['service' => $service->id ] ) );

        //     return back()->withInput();    
        // } 
        
        //return view('dashboard');
    }

    public function workflowTest(){
        $workflow = ServiceWorkflow::defineServiceWorkflow();

        $service = Service::find(15);

        print_r( $service );

        //Get service transitions
        $transitions = $workflow->getEnabledTransitions($service);
        foreach( $transitions as $item){
            print_r($item->getName());
            print_r($item->getFroms());
            print_r($item->getTos());
        }
    }
}
