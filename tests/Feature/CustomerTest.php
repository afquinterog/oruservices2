<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class CustomerTest extends TestCase
{
    use DatabaseMigrations;
    
    public function setUp(){
        parent::setUp();

        $this->customer = factory('App\Models\Customer')->create();

        $this->user = factory('App\User')->create();
    }

   
    /**
     * A user can create a customer
     *
     * @return void
     */
    public function testAUserCanCreateACustomer()
    {   

        $customer = factory('App\Models\Customer')->make();      

        $response = $this->actingAs($this->user)->post('/customers/store', $customer->toArray() );

        $response = $this->actingAs($this->user)->get('/customers');

        $response->assertSee( $customer->firstname );
    }

    /**
     * A user can edit a customer
     *
     * @return void
     */
    public function testAUserCanEditACustomer()
    {   

        $this->customer->firstName = "SampleName";

        $response = $this->actingAs($this->user)
                         ->post('/customers/store', $this->customer->toArray() );

        $response = $this->actingAs($this->user)->get('/customers/edit/' .  $this->customer->id );

        $response->assertSee( $this->customer->firstName );
    }


    /**
     * A user can view the customer list
     *
     * @return void
     */
    public function testAUserCanViewCustomers()
    {
        
        $response = $this->actingAs($this->user)->get('/customers');

        $response->assertSee( $this->customer->firstname );
    }

    /**
     * A user can view a branch
     *
     * @return void
     */
    public function testAUserCanViewACustomer()
    {

        $response = $this->actingAs($this->user)
                         ->get('/customers/edit/' . $this->customer->id );

        $response->assertSee( $this->customer->firstname );
    }


}