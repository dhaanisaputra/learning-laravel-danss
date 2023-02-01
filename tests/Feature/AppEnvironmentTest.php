<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class AppEnvironmentTest extends TestCase
{
    public function testAppEnv() 
    {
        // var_dump(App::environment()); //to get currently app_env

        // cek current app env
        if(App::environment('testing'))
        {
            self::assertTrue(true);
        }
    }
}
