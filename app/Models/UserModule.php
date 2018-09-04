<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Facades\App\Models\Role;
use App\Traits\Database;
use Silber\Bouncer\Bouncer;
use Illuminate\Support\Facades\DB;

class UserModule extends Model
{

  use Database;

	/**
   * List users
   *
   * @param array $data 
  */
  public static function list($filter)
  {

  	$filter = allQueryFormat( $filter );

    //Get users
    $users = User::where('name', 'LIKE', $filter )
                    ->orWhere('email', 'LIKE', $filter )
                    //->where( 'company_id', '=', auth()->user()->company->id )
                    ->orderBy("email", "ASC" );

    return $users->paginate(10);
  }

  /**
   * Save or update the model information
   *
   * @param array $data user data 
   */
  public function saveOrUpdate(array $data)
  {
    if( $data['password'] == "" ){
      unset( $data['password']);
    }else{
      $data['password'] = bcrypt( $data['password'] );
    }

    $saveUser = $this->persist( User::class, $data);

    $this->assignRole($saveUser, $data['role_id'] );

    return $saveUser;
  }

  /**
   * Assign a role to the user
   *
   * @param App\User $user
   * @param int $roleId 
   */
  public function assignRole($user, $roleId)
  {
    //Delete previous roles
    $this->deleteRoles($user);

    //Assign new role
    Bouncer::create()->assign( Role::find( $roleId )->name )->to( $user ); 
  }


  /**
   * Delete all user assigned roles
   *
   * @param App\User $user
   */
  public function deleteRoles($user)
  {
    $deleted = DB::delete('delete from assigned_roles where entity_id=' . $user->id );
  }
}






