<?php

use App\Providers\Application;
use App\Providers\Components\ContainerBuilder;
use App\Providers\Components\Serializer;
use App\Providers\Controllers\User as UserController;
use App\Providers\Services\User as UserService;
use Silex\Provider\HttpCacheServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;

date_default_timezone_set('America/Recife');
define("ROOT_PATH", __DIR__ . "/../");

$app->register(new ContainerBuilder());
$app->register(new Application());
$app->register(new ServiceControllerServiceProvider());
$app->register(new Serializer());
$app->register(new UserService());
$app->register(new UserController());
$app->register(new HttpCacheServiceProvider(), ["http_cache.cache_dir" => ROOT_PATH . "/data/cache",]);

return $app;