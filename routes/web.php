<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', '')


Auth::routes();

Route::group([ 'middleware' => 'auth'], function(){

	//Dashboard
	Route::get('/', 'HomeController@index');
	Route::get('/dashboard', 'HomeController@index')->name('home');

	//Services types routes
	Route::get('service-types', 'ServiceTypeController@index' );
	Route::get('service-types/new', 'ServiceTypeController@create' )->name('service-type-create');
	Route::get('service-types/edit/{serviceType}', 'ServiceTypeController@edit' )->name('service-type-edit');
	Route::get('service-types/delete/{id}', 'ServiceTypeController@destroy' )->name('service-type-delete');

	Route::post('service-types/store/basic', 'ServiceTypeController@storeBasic');
	Route::post('service-types/store/attribute', 'ServiceTypeController@storeAttribute');
	Route::post('service-types/store/task', 'ServiceTypeController@storeTask');
	Route::post('service-types/store/branch', 'ServiceTypeController@storeBranch');
	Route::post('service-types/store/role', 'ServiceTypeController@storeRole');
	

	//Attributes routes
	Route::get('attributes', 'AttributeController@index' );
	Route::get('attributes/new', 'AttributeController@create' )->name('attribute-create');
	Route::get('attributes/{attribute}/orderUp/service-type/{serviceType}', 'AttributeController@orderUp');
	Route::get('attributes/{attribute}/orderDown/service-type/{serviceType}', 'AttributeController@orderDown');
	Route::get('attributes/{attribute}/service-type/{serviceType}/delete', 'AttributeController@deleteAttribute');

	Route::get('attributes/edit/{attribute}', 'AttributeController@edit' )->name('attribute-edit');
	Route::get('attributes/delete/{id}', 'AttributeController@destroy' )->name('attribute-delete');

	Route::post('attributes/store', 'AttributeController@store');

	//Customers routes
	Route::get('customers', 'CustomerController@index' );
	Route::get('customers/new', 'CustomerController@create' )->name('customer-create');
	Route::get('customers/edit/{customer}', 'CustomerController@edit' )->name('customer-edit');
	Route::get('customers/delete/{id}', 'CustomerController@destroy' )->name('customer-delete');

	Route::post('customers/store', 'CustomerController@store');
	Route::post('customers/store/category', 'CustomerController@storeCategory');

	//Branches routes
	Route::get('branches', 'BranchController@index' );
	Route::get('branches/new', 'BranchController@create' )->name('branch-create');
	Route::get('branches/edit/{branch}', 'BranchController@edit' )->name('branch-edit');
	Route::get('branches/delete/{id}', 'BranchController@destroy' )->name('branch-delete');
	Route::get('branches/{branch}/orderUp/service-type/{serviceType}', 'BranchController@orderUp');
	Route::get('branches/{branch}/orderDown/service-type/{serviceType}', 'BranchController@orderDown');
	Route::get('branches/{branch}/service-type/{serviceType}/delete', 'BranchController@deleteBranch');

	Route::post('branches/store', 'BranchController@store');	

	//Tasks routes
	Route::get('tasks/{task}/orderUp/service-type/{serviceType}', 'TaskController@orderUp');
	Route::get('tasks/{task}/orderDown/service-type/{serviceType}', 'TaskController@orderDown');


	//Categories routes
	Route::get('categories', 'CategoryController@index' );
	Route::get('categories/new', 'CategoryController@create' )->name('category-create');
	Route::get('categories/edit/{category}', 'CategoryController@edit' )->name('category-edit');
	Route::get('categories/delete/{id}', 'CategoryController@destroy' )->name('category-delete');

	Route::post('categories/store', 'CategoryController@store');

	//Users routes
	Route::get('users', 'UserController@index' );
	Route::get('users/new', 'UserController@create' )->name('user-create');
	Route::get('users/edit/{user}', 'UserController@edit' )->name('user-edit');
	Route::get('users/delete/{id}', 'UserController@destroy' )->name('user-delete');

	Route::post('users/store/basic', 'UserController@storeBasic');
	Route::post('users/store/role', 'UserController@storeRole');

	//Roles routes
	Route::get('roles', 'RoleController@index' );
	Route::get('roles/new', 'RoleController@create' )->name('role-create');

	Route::get('roles/{role}/orderUp/user/{user}', 'RoleController@orderUp');
	Route::get('roles/{role}/orderDown/user/{user}', 'RoleController@orderDown');
	Route::get('roles/{role}/user/{user}/delete', 'RoleController@deleteRole');

	/*Route::get('roles/{role}/orderUp/service-type/{serviceType}', 'RoleController@orderUp');
	Route::get('roles/{role}/orderDown/service-type/{serviceType}', 'RoleController@orderDown');*/
	Route::get('roles/{role}/service-type/{serviceType}/delete', 'RoleController@deleteRoleServiceType');

	Route::get('roles/edit/{role}', 'RoleController@edit' )->name('role-edit');
	Route::get('roles/delete/{id}', 'RoleController@destroy' )->name('role-delete');

	Route::post('roles/store', 'RoleController@store');

});

