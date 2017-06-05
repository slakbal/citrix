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

        /*
        $app['config']->set('citrix.direct.CITRIX_DIRECT_USER', 'test@test.com');
        $app['config']->set('citrix.direct.CITRIX_DIRECT_PASSWORD', 'password123');
        $app['config']->set('citrix.direct.CITRIX_CONSUMER_KEY', 'abcdefg');

        $app['config']->set('citrix.oauth2.CITRIX_OAUTH_CONSUMER_KEY', 'direct');
        $app['config']->set('citrix.oauth2.CITRIX_OAUTH_CONSUMER_SECRET', 'direct');
        $app['config']->set('citrix.oauth2.CITRIX_OAUTH_REFRESH_KEY', 'direct');
        $app['config']->set('citrix.oauth2.CITRIX_OAUTH_REDIRECT_URI', 'direct');
        */

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