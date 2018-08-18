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

        $response->assertSee( $customer->name );
    }

    /**
     * A user can edit a branch
     *
     * @return void
     */
    public function testAUserCanEditABranch()
    {   

        $this->branch->name = "SampleName";

        $response = $this->actingAs($this->user)
                         ->post('/branches/store', $this->branch->toArray() );

        $response = $this->actingAs($this->user)->get('/branches/edit/' .  $this->branch->id );

        $response->assertSee( $this->branch->name );
    }


    /**
     * A user can view the branch list
     *
     * @return void
     */
    public function testAUserCanViewBranches()
    {
        //$this->artisan('migrate:fresh');
        
        $response = $this->actingAs($this->user)->get('/branches');

        $response->assertSee( $this->branch->name );
    }

    /**
     * A user can view a branch
     *
     * @return void
     */
    public function testAUserCanViewABranch()
    {

        $response = $this->actingAs($this->user)
                         ->get('/branches/edit/' . $this->branch->id );

        $response->assertSee( $this->branch->name );
    }


}