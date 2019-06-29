<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiVehicleTest extends TestCase
{
    /**
     * @test
     */
    public function list_vehicles()
    {
        $this->get('/vehicles/2015/Audi/A3')
            ->assertStatus(200);
    }
}
