<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades\App\Models\UserModule;
use Facades\App\Models\Company;
use Facades\App\Models\Role;
use Facades\App\User;

use App\Http\Requests\UsersModule\UserRequest;

class UserModuleController extends Controller
{

	/**
   * Display the user list 
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
     $data = $request->all();

     $filter = isset( $data->filter ) ? $data->filter : "";

     $users = UserModule::list( $filter );

     $request->flash();

     return view('modules.users.index', ['users' => $users ]);
  }


  public function create(Request $request)
  {
  	$roles = Role::list();

  	$companies = Company::list();

  	$request->flash();

    return view('modules.users.new', ['roles' => $roles, 'companies'  => $companies ]);

  }

  public function edit( $id, Request $request )
  {

  	$user = User::find( $id );
 
  	$roles = Role::list();

  	$companies = Company::list();

  	$request->flash();

    return view('modules.users.edit', [ 'user' => $user, 'roles' => $roles, 'companies'  => $companies ]);

  }

  public function store(UserRequest $request)
  {
  	UserModule::saveOrUpdate( $request->all() );

    $request->session()->flash('status', __('messages.saved_ok'));

    return back()->withInput();
  }
}










