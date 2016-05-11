<?php

namespace App\Providers\Controllers;

use App\Controllers\UserController;
use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\DependencyInjection\Container;

/**
 * Class User
 * @package App\Providers\Controllers
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
        $app['user.controller'] = new UserController($app['container']->get('user_service'));
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
        $api = $app["controllers_factory"];
        $api->get('/user', "user.controller:getAll");
        $api->post('/user', "user.controller:save");
        $api->put('/user/{id}', "user.controller:update");
        $api->delete('/user/{id}', "user.controller:delete");

        $route = '/';
        /** @var Container $container */
        $container = $app['container'];

        if ($container->hasParameter('endpoint')) {
            $route = $route . $container->getParameter('endpoint');
        }

        if ($container->hasParameter('version')) {
            $route = $route . '/' . $container->getParameter('version');
        }

        $app->mount($route, $api);
    }
}