<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    public function testGetEnv()
    {
        $learnlrv = env('LearnLaravel');

        self::assertEquals('Belajar Laravel', $learnlrv);
    }
}
