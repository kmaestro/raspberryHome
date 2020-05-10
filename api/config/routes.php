<?php

declare(strict_types=1);

use App\Http\Action;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return static function (App $app): void {
    $app->get('/', Action\HomeAction::class);
    $app->group('/v1', function (RouteCollectorProxy $group): void {
      $group->get('/temperature', Action\V1\Temperature\GetAction::class);
    });
};
