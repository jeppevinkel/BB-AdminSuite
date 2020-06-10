<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeRedirectTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/home');

        $response->assertRedirect('/email/verify');
    }
}
