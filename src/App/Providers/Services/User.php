<?php

namespace App\Providers\Services;

use App\Services\UserService;
use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * Class User
 * @package App\Providers\Services
 */
class User implements ServiceProviderInterface
{

    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     */
    public function register(Application $app)
    {
        $app['user.service'] = $app['container']->get('user_service');
    }

    /**
     * Bootstraps the application.
     *
     * This method is called after all services are registered
     * and should be used for "dynamic" configuration (whenever
     * a service must be requested).
     */
    public function boot(Application $app)
    {
        // TODO: Implement boot() method.
    }
}