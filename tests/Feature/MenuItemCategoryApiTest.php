<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MenuItemCategoryApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/api/menu/item/category');
        $response->assertStatus(200);
    }

    public function testRetrieveMenuItemCategorySuccessfully()
    {
        $this->json('GET', 'api/menu/item/category?page=2', [], ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "message" => "Success"
            ]);
    }
}
