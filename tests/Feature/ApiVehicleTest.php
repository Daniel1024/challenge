<?php

namespace Tests\Feature;

use Tests\TestCase;

class ApiVehicleTest extends TestCase
{
    private $resulJson = [
        'Count' => 4,
        'Results' => [
            ['Description' => '2015 Audi A3 4 DR AWD', 'VehicleId' => 9403],
            ['Description' => '2015 Audi A3 4 DR FWD', 'VehicleId' => 9408],
            ['Description' => '2015 Audi A3 C AWD', 'VehicleId' => 9405],
            ['Description' => '2015 Audi A3 C FWD', 'VehicleId' => 9406]
        ]
    ];
    /**
     * @test
     */
    public function get_list_vehicles()
    {
        $this->get('/vehicles/2015/Audi/A3')
            ->assertStatus(200)
            ->assertJson($this->resulJson);
    }

    /**
     * @test
     */
    public function post_list_vehicles()
    {
        $this->post('/vehicles', [
            'modelYear' => 2015,
            'manufacturer' => 'Audi',
            'model' => 'A3'
        ])
            ->assertStatus(200)
            ->assertJson($this->resulJson);
    }
}
