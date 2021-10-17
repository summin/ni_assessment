<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testProducts()
    {
        $response = $this->post('/auth', ['email' => 'mac94@moen.com', 'password' => 'secret']);
        $response->assertStatus(200);
    }
}
