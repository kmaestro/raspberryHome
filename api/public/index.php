<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Symfony\Component\Dotenv\Dotenv;
use Slim\App;

require __DIR__ . '/../vendor/autoload.php';

if (file_exists(__DIR__ . '/../.env')) {
    (new Dotenv())->load(__DIR__ . '/../.env');
    var_dump($_ENV['API_DB_URL']);
}

/** @var ContainerInterface $container */
$container = require __DIR__ . '/../config/container.php';

/** @var App $app */
$app = (require __DIR__ . '/../config/app.php')($container);
$app->run();