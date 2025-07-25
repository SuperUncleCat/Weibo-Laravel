<?php

namespace Tests\Feature;

use Tests\TestCase;

class StatusesControllerTest extends TestCase
{
    public function test_guest_cannot_create_status()
    {
        $response = $this->post('/statuses', ['content' => 'Test status']);

        $response->assertRedirect('/login');
    }
}

