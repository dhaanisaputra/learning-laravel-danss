<?php

namespace Tests\Feature;

use http\Env\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=dans')
            ->assertSeeText('Hello dans');

        $this->post('/input/hello', ['name' => 'dans'])->assertSeeText('Hello dans');
    }

    public function testNestedInput()
    {
        $this->post('/input/hello/first', [
            "name" => [
                "first" => "dans",
                "last" => "ganteng"
            ]
        ])->assertSeeText("Hello dans");
    }

    public function testInputAll()
    {
        $this->post('input/hello/input', [
            "name" => [
                "first" => "dans",
                "last" => "ganteng"
            ]
        ])->assertSeeText("name")->assertSeeText("first")
            ->assertSeeText("last")->assertSeeText("dans")
            ->assertSeeText("ganteng");
    }

    public function testInputArray()
    {
        $this->post('input/hello/array', [
            "products" => [
                [
                    "name" => "Apple MacBook Pro",
                    "price" => 25000000
                ],
                [
                    "name" => "Asus ROG",
                    "price" => 18000000
                ]
            ]
        ])->assertSeeText("Apple MacBook Pro")
            ->assertSeeText("Asus ROG");
    }

}
