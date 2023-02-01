<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    public function testConfig()
    {
        $firstname = config('contoh-dani.name.first');
        $lastname = config('contoh-dani.name.last');
        $email = config('contoh-dani.email');

        self::assertEquals('dani', $firstname);
        self::assertEquals('ganteng', $lastname);
        self::assertEquals('danniisaputra05@gmail.com', $email);
    }
}
