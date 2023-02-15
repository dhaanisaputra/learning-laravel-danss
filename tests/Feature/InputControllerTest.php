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

    public function testInputType()
    {
        $this->post('/input/type', [
            'name'=>'dans',
            'married'=>'true',
            'birth_date'=>'2000-01-01'
        ])->assertSeeText('dans')
            ->assertSeeText("true")
            ->assertSeeText("2000-01-01");
    }

    public function testFilterOnly()
    {
        $this->post('input/filter/only', [
            "name" => [
                "first" => "dani",
                "middle" => "itu",
                "last" => "ganteng"
            ]
        ])->assertSeeText("dani")->assertSeeText("ganteng")->assertDontSeeText("itu");
    }

    public function testFilterExcept()
    {
        $this->post('input/filter/except', [
            "username" => "dani",
            "admin" => "true",
            "password" => "rahasia"
        ])->assertSeeText("dani")->assertSeeText("rahasia")->assertDontSeeText("admin");
    }

    public function testFilterMerge()
    {
        $this->post('input/filter/merge', [
            "username" => "dani",
            "admin" => "true",
            "password" => "rahasia"
        ])->assertSeeText("dani")->assertSeeText("rahasia")->assertSeeText("admin")->assertSeeText("false");
    }
}
