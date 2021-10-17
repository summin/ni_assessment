<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testProducts()
    {
        $response = $this->get('/products');
        $response->assertStatus(200);

        $response = $this->delete('/products/irregularVar');
        $response->assertStatus(401);
    }
}
