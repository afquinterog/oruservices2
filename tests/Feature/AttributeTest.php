<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;


class AttributeTest extends TestCase
{
    use DatabaseMigrations;

    
    public function setUp(){

        parent::setUp();

        $this->attribute = factory('App\Models\Attribute')->create();

        $this->user = factory('App\User')->create();
    }

   
    /**
     * A user can create an attribute
     *
     * @return void
     */
    public function testAUserCanCreateAnAttribute()
    {   

        $attribute = factory('App\Models\Attribute')->make();   

        $response = $this->actingAs($this->user)->post('/attributes/store', $attribute->toArray() );

        $response = $this->actingAs($this->user)->get('/attributes');

        $response->assertSee( $this->attribute->name );
    }


    /**
     * A user can edit an attribute
     *
     * @return void
     */
    public function testAUserCanEditAnAttribute()
    {   

        $this->attribute->name = "SampleName";

        $response = $this->actingAs($this->user)
                         ->post('/attributes/store', $this->attribute->toArray() );

        $response = $this->actingAs($this->user)->get('/attributes/edit/' .  $this->attribute->id );

        $response->assertSee( $this->attribute->name );
    }


    /**
     * A user can view the attribute list
     *
     * @return void
     */
    public function testAUserCanViewAttributes()
    {
        
        $response = $this->actingAs($this->user)->get('/attributes');

        $response->assertSee( $this->attribute->name );
    }


    /**
     * A user can view an attribute
     *
     * @return void
     */
    public function testAUserCanViewAnAttribute()
    {

        $response = $this->actingAs($this->user)
                         ->get('/attributes/edit/' . $this->attribute->id );

        $response->assertSee( $this->attribute->name );
    }


}