<?php

namespace App\Providers\Components;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder as ContainerBuilderSymfony;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Class ContainerBuilder
 * @package App\Providers\Components
 */
class ContainerBuilder implements ServiceProviderInterface
{

    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     */
    public function register(Application $app)
    {
        $container = new ContainerBuilderSymfony();
        $loader = new YamlFileLoader($container, new FileLocator(ROOT_PATH . '/config'));
        $loader->load('config.yml');
        $loader->load('deve.yml');
        $loader = new YamlFileLoader($container, new FileLocator(ROOT_PATH . '/src/Resources'));
        $loader->load('services.yml');

//        if (!getenv('environment')) {
//            $loader->load('prod.yml');
//        }

        $app['container'] = $container;
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