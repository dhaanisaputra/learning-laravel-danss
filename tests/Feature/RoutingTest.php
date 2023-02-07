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

    public function testRouteParameter()
    {
        $this->get('products/1')
            ->assertSeeText('Product 1');

        $this->get('products/2')
            ->assertSeeText('Product 2');

        $this->get('products/1/items/XXX')
            ->assertSeeText("Product 1, Items XXX");

        $this->get('products/2/items/YYY')
            ->assertSeeText("Product 2, Items YYY");
    }

    public function testRouteParameterRegex()
    {
        $this->get('/categories/123456')->assertSeeText("Categories : 123456");
        $this->get('/categories/salah')->assertSeeText("404 by dansss");
    }

    public function testRouteParameterOptional()
    {
        $this->get('/users/alpha')->assertSeeText("User alpha");
        $this->get('/users/')->assertSeeText("User 404");
    }

    public function testRouteParameterConflict() {
        $this->get('/conflict/coba')
            ->assertSeeText("Conflict coba");

        $this->get('conflict/dans')
            ->assertSeeText("Conflict dani ganteng");
    }
}
