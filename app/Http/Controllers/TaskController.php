<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;
use App\Models\ServiceType;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    * Move the task order up
    *
    * @param  int  $task
    * @return \Illuminate\Http\Response
    */
    public function orderUp(Task $task, ServiceType $serviceType)
    {
        $task->orderUp( $serviceType );

        request()->session()->flash('status', __('messages.saved_ok'));

        request()->session()->flash('tab', "tasks" );

        return redirect()->route('service-type-edit', [ 'serviceType' => $serviceType->id ]);
    }

    /**
    * Move the task order down
    *
    * @param  int  $task
    * @return \Illuminate\Http\Response
    */
    public function orderDown(Task $task, ServiceType $serviceType)
    {
        $task->orderDown( $serviceType );

        request()->session()->flash('status', __('messages.saved_ok'));

        request()->session()->flash('tab', "tasks" );

        return redirect()->route('service-type-edit', [ 'serviceType' => $serviceType->id ]);
    }

   
    /**
    * Delete the task from the service type
    *
    * @param  int  $task
    * @return \Illuminate\Http\Response
    */
    public function deleteTaskFromServiceType(Request $request)
    {
        $task = $request->input('task');
        $task = Task::find($task);
        $task->delete();

        request()->session()->flash('status', __('messages.deleted_ok'));
        request()->session()->flash('tab', "tasks" );

        return back()->withInput();
    }
}
