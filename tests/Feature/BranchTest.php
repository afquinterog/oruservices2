<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class BranchTest extends TestCase
{
    use DatabaseMigrations;
    
    public function setUp(){
        parent::setUp();

        $this->branch = factory('App\Models\Branch')->create();

        $this->user = factory('App\User')->create();
    }

   
    /**
     * A user can create a branch
     *
     * @return void
     */
    public function testAUserCanCreateABranch()
    {   

        $branch = factory('App\Models\Branch')->make();      

        $response = $this->actingAs($this->user)->post('/branches/store', $branch->toArray() );

        $response = $this->actingAs($this->user)->get('/branches');

        $response->assertSee( $branch->name );
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