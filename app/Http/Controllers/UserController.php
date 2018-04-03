<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Role;
use App\Http\Requests\Users\BasicRequest;


class UserController extends Controller
{
    /**
     * Display the user list 
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = allQueryFormat( $request->filter );

        $users = User::where('name', 'LIKE', $filter )->paginate(10);

        $request->flash();
        
        return view('users.index', ['users' => $users ]);
    }

    /**
     * Show the form for creating a new service type
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.new');
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
    public function edit(User $user)
    {
        $user->load("roles");

        $roles = Role::list();

        return view('users.edit', ['user' => $user, 'roles' => $roles ]);
    }

    /**
     * Store service type basic information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeBasic(BasicRequest $request)
    {
        
        $user = new User;

        $user->saveOrUpdate( $request->all() );

        $request->session()->flash('status', __('messages.saved_ok'));

        return redirect()->action('UserController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy( $id );

        request()->session()->flash('status', __('messages.deleted_ok'));

        return redirect()->action('UserController@index');

    }

    /**
     * Store an role linked with the user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRole(Request $request)
    {
        
        $user = User::find( $request->user );

        $order = $user->nextRoleOrder();

        $user->roles()->attach( $request->role, ['order' => $order ] );

        request()->session()->flash('status', __('messages.saved_ok'));

        request()->session()->flash( 'tab', "roles" );

        return redirect()->route('user-edit', [ 'user' => $user->id ]);
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
    
}
