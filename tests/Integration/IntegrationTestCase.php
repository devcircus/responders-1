<?php

namespace PerfectOblivion\Responder\Tests\Integration;

use Orchestra\Testbench\TestCase as Orchestra;
use PerfectOblivion\Responder\ResponderServiceProvider;

class IntegrationTestCase extends Orchestra
{
    /**
     * Setup the test case.
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Tear down the test case.
     */
    public function tearDown()
    {
        parent::tearDown();

        $file = app('Illuminate\Filesystem\Filesystem');
        $file->cleanDirectory(base_path().'/app/Http/Responders');
    }

    /**
     * Load ServiceProviders.
     */
    protected function getPackageProviders($app)
    {
        return [
            ResponderServiceProvider::class,
        ];
    }

    /**
     * Configure the environment.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app->setBasePath(__DIR__.'/../../vendor/orchestra/testbench-core/laravel/');

        $app['config']->set('responders.namespace', 'Http\\Responders');
        $app['config']->set('responders.method', 'respond');
        $app['config']->set('responders.suffix', 'Responder');
        $app['config']->set('responders.override_duplicate_suffix', true);
    }
}
