<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    public function testDependency()
    {
        $foo1 = $this->app->make(Foo::class); // new Foo()
        $foo2 = $this->app->make(Foo::class); // new Foo()

        self::assertEquals('Foo', $foo1->foo());
        self::assertEquals('Foo', $foo2->foo());
        self::assertNotSame($foo1, $foo2);
        
    }

    public function testBind()
    {
        // $person = $this->app->make(Person::class);
        // self::assertNotNull($person);

        $this->app->bind(Person::class, function ($app) {
            return new Person("dani", "ganteng");
        });

        $person1 = $this->app->make(Person::class); //closure > new Person("dani", "ganteng") 
        $person2 = $this->app->make(Person::class); //closure > new Person("dani", "ganteng"

        self::assertEquals("dani", $person1->firstname);
        self::assertEquals("dani", $person2->firstname);
        self::assertNotSame($person1, $person2);
        
    }

    public function testSingleton()
    {
        $this->app->singleton(Person::class, function ($app) {
            return new Person("dani", "ganteng");
        });

        $person1 = $this->app->make(Person::class); // new Person("dani", "ganteng") ; if not exist
        $person2 = $this->app->make(Person::class); // retun existing

        self::assertEquals("dani", $person1->firstname);
        self::assertEquals("dani", $person2->firstname);
        self::assertSame($person1, $person2);
        
    }

    public function testInstance()
    {
        $person = new Person("dani", "ganteng");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class); // $person
        $person2 = $this->app->make(Person::class); // $person

        self::assertEquals("dani", $person1->firstname);
        self::assertEquals("dani", $person2->firstname);
        self::assertSame($person1, $person2);
        
    }

    public function testDependencyInjection()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $this->app->singleton(Bar::class, function ($app){
            $foo = $app->make(Foo::class);
            return new Bar($foo);
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);
        
        self::assertSame($foo, $bar1->foo);
        self::assertSame($bar1, $bar2);
    }

    public function testInterfaceToClass()
    {
        // $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        $this->app->singleton(HelloService::class, function($app){
            return new HelloServiceIndonesia();
        });

        $helloService = $this->app->make(HelloService::class);

        self::assertEquals('Halo dani', $helloService->hello('dani'));
        
    }

}
