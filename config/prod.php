<?php
$app['log.level'] = getenv('environment') === 'deve' ? Monolog\Logger::DEBUG : Monolog\Logger::ERROR;
$app['debug'] = getenv('environment') === 'deve' ? true : false;
$app['api.version'] = "v1";
$app['api.endpoint'] = "api";