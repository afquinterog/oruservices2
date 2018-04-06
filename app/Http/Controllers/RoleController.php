<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Silber\Bouncer\Database\Role;
use App\Models\User;
use App\Models\ServiceType;
use App\Http\Requests\Roles\BasicRequest;

class RoleController extends Controller
{
    
    /**
     * Display the Role list 
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = allQueryFormat($request->filter);

        $roles = Role::where('name', 'LIKE', $filter )->paginate(10);

        $request->flash();

        return view('roles.index', ['roles' => $roles ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = new Role;

        return view('roles.new');
    }

    /**
     * Store Role information
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BasicRequest $request)
    {
        $role = new Role;

        $data = $request->all();

        $role = ( isset( $data['id']) ) ? Role::find( $data['id'] ) : new Role ;

        $role->fill( $data );

        $role->save();

        request()->session()->flash('status', __('messages.saved_ok'));

        return redirect()->action('RoleController@index');        
    }

    /**
     * Store user basic information.
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
    public function edit(Role $role)
    {

        return view('roles.edit', ['role' => $role]);
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
        Role::destroy( $id );

        request()->session()->flash('status', __('messages.deleted_ok'));

        return back()->withInput();

    }

    /**
    * Move the role order up
    *
    * @param  int  $role
    * @return \Illuminate\Http\Response
    */
    public function orderUp(Role $role, User $user)
    {
        $role->orderUp( $user );

        request()->session()->flash("status", __('messages.saved_ok'));

        request()->session()->flash("tab", "roles" );

        return redirect()->route('user-edit', [ 'user' => $user->id ]);
    }

    /**
    * Move the role order down
    *
    * @param  int  $role
    * @return \Illuminate\Http\Response
    */
    public function orderDown(Role $role, User $user)
    {
        $role->orderDown( $user );

        request()->session()->flash("status", __('messages.saved_ok'));

        request()->session()->flash("tab", "roles" );

        return redirect()->route('user-edit', [ 'user' => $user->id ]);
    }

    /**
    * Delete the role on the user
    *
    * @param  int  $role
    * @return \Illuminate\Http\Response
    */
    public function deleteRole(Role $role, User $user)
    {
        $user->Roles()->detach( $role->id);

        request()->session()->flash('status', __('messages.deleted_ok'));

        request()->session()->flash('tab', "roles" );

        return back()->withInput();
    }

    /**
    * Delete the role on the service type
    *
    * @param  int  $role
    * @return \Illuminate\Http\Response
    */
    public function deleteRoleServiceType(Role $role, ServiceType $serviceType)
    {
        $serviceType->Roles()->detach( $role->id);

        request()->session()->flash('status', __('messages.deleted_ok'));

        request()->session()->flash('tab', "assign" );

        return back()->withInput();
    }

}
