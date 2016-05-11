<?php

namespace App\Providers\Components;

use JMS\Serializer\SerializerBuilder;
use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\DependencyInjection\Container;

/**
 * Class Serializer
 * @package App\Providers\Components
 */
class Serializer implements ServiceProviderInterface
{

    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     */
    public function register(Application $app)
    {
        $app['serializer'] = SerializerBuilder::create()
            ->setCacheDir(ROOT_PATH . '/data/cache')
            ->setDebug($app['debug'])
            ->build()
        ;
        $app['container']->set('serializer', $app['serializer']);
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