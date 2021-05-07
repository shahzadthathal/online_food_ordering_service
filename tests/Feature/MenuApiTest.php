<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MenuApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/api/menu');
        $response->assertStatus(200);
    }

    public function testRetrieveMenuSuccessfully()
    {
        $this->json('GET', 'api/menu?page=2', [], ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "message" => "Success"
            ]);
    }
}
