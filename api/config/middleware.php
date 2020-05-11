<?php

declare(strict_types=1);

use Middlewares\ContentLanguage;
use Slim\App;
use Slim\Middleware\ErrorMiddleware;

return static function (App $app): void {
    $app->add(ContentLanguage::class);
    $app->addBodyParsingMiddleware();
    $app->add(ErrorMiddleware::class);
};
