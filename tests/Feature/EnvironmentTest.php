<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Env;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class EnvironmentTest extends TestCase
{
    public function testGetEnv()
    {
        $learn = env('LearnLaravel');
        self::assertEquals('Belajar Laravel', $learn);
        
    }

    public function testDefaultEnv() 
    {
        // $author = env('AUTHOR', 'dani');
        $author = Env::get('AUTHOR', 'dani');
        self::assertEquals('dani', $author);
    }
}
