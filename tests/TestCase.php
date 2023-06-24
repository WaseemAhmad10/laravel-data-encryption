<?php

namespace Waseem\Encipher\Tests;


use Waseem\Encipher\EncryptServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /**
     * Load the package service provider.
     *
     * @param $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [EncryptServiceProvider::class];
    }

    /**
     * Set up the test case.
     */
    function setUp() : void
    {
        parent::setUp();
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->withFactories(__DIR__ . '/database/factories');
    }

    public function createUserWithPhone($name = 'Wasi Doe', $email = 'wasi@demo.com', $phone_number = '123465789') : TestUser
    {
        $user = $this->createUser($name, $email);

        $user->phones()->create(compact('phone_number'));

        return $user->load('phones');
    }

    public function createUser($name = 'Wasi Doe', $email = 'wasi@demo.com') : TestUser
    {
        return factory(TestUser::class)->create(compact('name', 'email'));
    }
}