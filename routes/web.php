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
	

	//Attributes 
	Route::get('attributes', 'AttributeController@index' );
	Route::get('attributes/new', 'AttributeController@create' )->name('attribute-create');
	Route::get('attributes/{attribute}/orderUp/service-type/{serviceType}', 'AttributeController@orderUp');
	Route::get('attributes/{attribute}/orderDown/service-type/{serviceType}', 'AttributeController@orderDown');
	Route::get('attributes/{attribute}/service-type/{serviceType}/delete', 'ServiceTypeController@deleteAttribute');

	Route::get('attributes/edit/{attribute}', 'AttributeController@edit' )->name('attribute-edit');
	Route::get('attributes/delete/{id}', 'AttributeController@destroy' )->name('attribute-delete');

	Route::post('attributes/store', 'AttributeController@store');

	//Customers 
	Route::get('customers', 'CustomerController@index' );
	Route::get('customers/new', 'CustomerController@create' )->name('customer-create');
	Route::get('customers/edit/{customer}', 'CustomerController@edit' )->name('customer-edit');
	Route::get('customers/delete/{id}', 'CustomerController@destroy' )->name('customer-delete');

	Route::post('customers/store', 'CustomerController@store');

	//Branches 
	Route::get('branches', 'BranchController@index' );
	Route::get('branches/new', 'BranchController@create' )->name('branch-create');
	Route::get('branches/edit/{branch}', 'BranchController@edit' )->name('branch-edit');
	Route::get('branches/delete/{id}', 'BranchController@destroy' )->name('branch-delete');

	Route::post('branches/store', 'BranchController@store');	

	//Tasks 
	Route::get('tasks/{task}/orderUp/service-type/{serviceType}', 'TaskController@orderUp');
	Route::get('tasks/{task}/orderDown/service-type/{serviceType}', 'TaskController@orderDown');


	//Categories 
	Route::get('categories', 'CategoryController@index' );
	Route::get('categories/new', 'CategoryController@create' )->name('category-create');
	Route::get('categories/edit/{category}', 'CategoryController@edit' )->name('category-edit');
	Route::get('categories/delete/{id}', 'CategoryController@destroy' )->name('category-delete');

	Route::post('categories/store', 'CategoryController@store');

});

