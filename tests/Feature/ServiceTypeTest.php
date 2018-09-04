<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ServiceTypeTest extends TestCase
{
    use DatabaseMigrations;
    
    
    public function setUp(){
        parent::setUp();

        $this->serviceType = factory('App\Models\ServiceType')->create();
        $this->user = factory('App\User')->create();
    }

   
    
    /**
     * A user can create a service type
     *
     * @return void
     */
    public function testAUserCanCreateAServiceType()
    {   

        $serviceType = factory('App\Models\ServiceType')->make();

        $response = $this->actingAs($this->user)->post('/service-types/store/basic', $serviceType->toArray() );

        $response = $this->actingAs($this->user)->get('/service-types');

        $response->assertSee( $serviceType->name );
    }

    /**
     * A user can edit a service type
     *
     * @return void
     */
    public function testAUserCanEditAServiceType()
    {   

        $this->serviceType->name = "SampleName";

        $response = $this->actingAs($this->user)
                         ->post('/service-types/store/basic', $this->serviceType->toArray() );

        $response = $this->actingAs($this->user)->get('/service-types/edit/' .  $this->serviceType->id );

        $response->assertSee( $this->serviceType->name );
    }


    /**
     * A user can view service types list
     *
     * @return void
     */
    public function testAUserCanViewServiceTypes()
    {
        //$this->artisan('migrate:fresh');
        
        $response = $this->actingAs($this->user)->get('/service-types');

        $response->assertSee( $this->serviceType->name );
    }

    /**
     * A user can view a service type
     *
     * @return void
     */
    public function testAUserCanViewAServiceType()
    {

        $response = $this->actingAs($this->user)
                         ->get('/service-types/edit/' . $this->serviceType->id );

        $response->assertSee( $this->serviceType->name );
    }

    


     /**
     * A user can add an attribute to a service type
     *
     * @return void
     */
    public function testAUserCanAddAnAttributeToAServiceType()
    {

        $attribute = factory('App\Models\Attribute')->create();

        $params = array(
            'attribute' => $attribute->id,
            'service'   => $this->serviceType->id 
        );

        $this->actingAs($this->user)->post('service-types/store/attribute', $params );

        $response = $this->actingAs($this->user)
                         ->get("service-types/edit/{$this->serviceType->id}" );
        
        $response->assertSee( "<td>" . $attribute->name . "</td>");
    }

    /**
     * A user can add an attribute to a service type
     *
     * @return void
     */
    public function testAUserCanAddATaskToAServiceType()
    {

        $task = factory('App\Models\Task')->create();

        $params = array(
            'name' => $task->name,
            'description' => $task->description,
            'service'  => $this->serviceType->id 
        );

        $this->actingAs($this->user)->post('service-types/store/task', $params );

        $response = $this->actingAs($this->user)
                         ->get("service-types/edit/{$this->serviceType->id}" );
        
        $response->assertSee( "<td>" . $task->name . "</td>");
    }

    /**
     * A user can assign a role to a service type
     *
     * @return void
     */
    public function testAUserCanAssignARoleToAServiceType()
    {

        $role = factory('App\Models\Role')->create();

        $params = array(
            'role' => $role->id,
            'service'   => $this->serviceType->id 
        );

        $this->actingAs($this->user)->post('service-types/store/role', $params );

        $response = $this->actingAs($this->user)
                         ->get("service-types/edit/{$this->serviceType->id}" );
        
        $response->assertSee( "<td>" . $role->name . "</td>");
    }


    /**
     * A user can remove an attribute from a service type
     *
     * @return void
     */
    public function testAUserCanRemoveAnAtrributeFromAServiceType()
    {
        $attribute = factory('App\Models\Attribute')->create();

        $params = array(
            'attribute' => $attribute->id,
            'service'   => $this->serviceType->id 
        );

        $this->actingAs($this->user)->post('service-types/store/attribute', $params );

        echo "attributes/{$attribute->id}/service-type/{$this->serviceType->id}/delete";

        $this->actingAs($this->user)
             ->get("attributes/{$attribute->id}/service-type/{$this->serviceType->id}/delete");

        $response = $this->actingAs($this->user)
                         ->get("service-types/edit/{$this->serviceType->id}" );

        $response->assertDontSee( "<td>" . $attribute->name . "</td>" );
    }


    /**
     * A user can remove an attribute from a service type
     *
     * @return void
     */
    public function testAUserCanRemoveATaskFromAServiceType()
    {
        $attribute = factory('App\Models\Task')->create();

        $params = array(
            'task' => $attribute->id,
            'service'   => $this->serviceType->id 
        );

        $this->actingAs($this->user)->post('service-types/store/task', $params );

        echo "attributes/{$attribute->id}/service-type/{$this->serviceType->id}/delete";

        $this->actingAs($this->user)
             ->get("attributes/{$attribute->id}/service-type/{$this->serviceType->id}/delete");

        $response = $this->actingAs($this->user)
                         ->get("service-types/edit/{$this->serviceType->id}" );

        $response->assertDontSee( "<td>" . $attribute->name . "</td>" );
    }


}