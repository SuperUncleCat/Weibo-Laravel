<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Ensure password reset email route redirects.
     *
     * @return void
     */
    public function testPasswordEmailPostRedirects()
    {
        $response = $this->post('/password/email', ['email' => 'foo@example.com']);

        $response->assertStatus(302);
    }
}
