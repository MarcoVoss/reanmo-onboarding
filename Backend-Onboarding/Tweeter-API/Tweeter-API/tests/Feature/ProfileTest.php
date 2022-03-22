<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    public function test_index() {
        $auth = Auth::shouldReceive('user')->once()->andreturn(new \stdClass());

    }

    public function test_show() {
        $response = $this->get('/api/profiles/1');
        $response->assertStatus(200);
    }
}
