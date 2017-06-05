<?php

namespace Slakbal\Citrix\Test;

use Orchestra\Testbench\TestCase as Orchestra;

abstract class BaseFunctionalTestCase extends Orchestra
{
    protected $testHelper;


    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('citrix.auth_type', 'direct');
        $app['config']->set('mail.driver', 'log');
    }

    /**
     * Get application timezone.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return string|null
     */
    protected function getApplicationTimezone($app)
    {
        return 'Europe/Berlin';
    }

}