<?php

namespace App\Providers;

use Carbon\Carbon;
use Monolog\Logger;
use Silex\Application as ApplicationSilex;
use Silex\Provider\MonologServiceProvider;
use Silex\ServiceProviderInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Application
 * @package App\Providers
 */
class Application implements ServiceProviderInterface
{

    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     */
    public function register(ApplicationSilex $app)
    {
    }

    /**
     * Bootstraps the application.
     *
     * This method is called after all services are registered
     * and should be used for "dynamic" configuration (whenever
     * a service must be requested).
     */
    public function boot(ApplicationSilex $app)
    {
        /** @var Container $container */
        $container = $app['container'];

        $app->before(function (Request $request) {

            if ($request->getMethod() === "OPTIONS") {
                $response = new Response();
                $response->headers->set("Access-Control-Allow-Origin","*");
                $response->headers->set("Access-Control-Allow-Methods","GET,POST,PUT,DELETE,OPTIONS");
                $response->headers->set("Access-Control-Allow-Headers","Content-Type");
                $response->setStatusCode(200);

                return $response->send();
            }
        }, ApplicationSilex::EARLY_EVENT);

        $app->after(function (Request $request, Response $response) {
            $response->headers->set("Access-Control-Allow-Origin","*");
            $response->headers->set("Access-Control-Allow-Methods","GET,POST,PUT,DELETE,OPTIONS");
        });

        $app->before(function (Request $request) {
            if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
                $data = json_decode($request->getContent(), true);
                $request->request->replace(is_array($data) ? $data : []);
            }
        });

        $app->register(new MonologServiceProvider(), [
            "monolog.logfile" => ROOT_PATH . "data/logs/" . Carbon::now('America/Recife')->format("d-m-Y") . ".log",
            "monolog.level" => $container->getParameter('debug') ? Logger::DEBUG : Logger::ERROR,
            "monolog.name" => "application"
        ]);

        $app->error(function (\Exception $e, $code) use ($app) {
            $app['monolog']->addError($e->getMessage());
            $app['monolog']->addError($e->getTraceAsString());

            return new JsonResponse(["statusCode" => $code, "message" => 'Method Not supported']);
        });
    }
}