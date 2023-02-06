<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Dani');

        $this->get('/hello-again')
            ->assertSeeText('Hello Dani');
    }

    public function testNestedView()
    {
        $this->get('/hello-world')
            ->assertSeeText('World Dani');
    }

    public function testTemplate()
    {
        $this->view('hello', ['name' => 'Dani'])
            ->assertSeeText('Hello Dani');

        $this->view('hello.world', ['name' => 'Dani'])
            ->assertSeeText('World Dani');
    }
}
