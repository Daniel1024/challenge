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
            ->assertExactJson($this->resulJson);
    }

    /**
     * @test
     */
    public function get_list_vehicles_without_results()
    {
        $this->get('/vehicles/2051/Audi/A3')
            ->assertStatus(200)
            ->assertExactJson([
                'Count' => 0,
                'Results' => []
            ]);
    }

    /**
     * @test
     */
    public function get_list_vehicles_with_rating_true()
    {
        $this->get('/vehicles/2015/Audi/A3?withRating=true')
            ->assertStatus(200)
            ->assertExactJson([
                'Count' => 4,
                'Results' => [
                    ['CrashRating' => '5', 'Description' => '2015 Audi A3 4 DR AWD', 'VehicleId' => 9403],
                    ['CrashRating' => '5', 'Description' => '2015 Audi A3 4 DR FWD', 'VehicleId' => 9408],
                    ['CrashRating' => 'Not Rated', 'Description' => '2015 Audi A3 C AWD', 'VehicleId' => 9405],
                    ['CrashRating' => 'Not Rated', 'Description' => '2015 Audi A3 C FWD', 'VehicleId' => 9406]
                ]
            ]);
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
            ->assertExactJson($this->resulJson);
    }

    /**
     * @test
     */
    public function post_list_vehicles_without_results()
    {
        $this->post('/vehicles', [
            'modelYear' => 2051,
            'manufacturer' => 'Audi',
            'model' => 'A3'
        ])
            ->assertStatus(200)
            ->assertExactJson([
                'Count' => 0,
                'Results' => []
            ]);
    }
}
