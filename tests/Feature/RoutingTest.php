<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testGet()
    {
        $this->get('/hwg')
            ->assertStatus(200)
            ->assertSeeText('Hello dani ganteng');
    }

    public function testRedirect()
    {
        $this->get('/youtube')
            ->assertRedirect('/hwg');
    }

    public function testFallback()
    {
        $this->get('/tidakada')
            ->assertSeeText('404 by dansss');
    }


}
