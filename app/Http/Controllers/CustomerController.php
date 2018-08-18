<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Customer;
use App\Models\Category;
use App\Http\Requests\Customers\BasicRequest;

class CustomerController extends Controller
{
    
    /**
     * Display the customers list 
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = allQueryFormat($request->filter);

        $customers = Customer::where('firstname', 'LIKE', $filter )->paginate(10);

        $request->flash();

        return view('customers.index', ['customers' => $customers ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = new Customer;

        $customer->load("categories");

        $categories = Category::list();
        
        return view('customers.new', ['categories' => $categories ]);
    }

    /**
     * Store customer information
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BasicRequest $request)
    {
        $customer = new Customer;

        $customer->saveOrUpdate( $request->all() );

        $request->session()->flash('status', __('messages.saved_ok'));  

        return redirect()->action('CustomerController@index');
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
    public function edit(Customer $customer)
    {
        $customer->load("categories");

        $categories = Category::list();

        return view('customers.edit', ['customer' => $customer, 'categories' => $categories ]);
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
        Customer::destroy( $id );

        request()->session()->flash('status', __('messages.deleted_ok'));

        return redirect()->action('CustomerController@index');

    }

    public function find(Request $request)
    {
        return Customer::search($request->get('filter'))->get();
    }

}
