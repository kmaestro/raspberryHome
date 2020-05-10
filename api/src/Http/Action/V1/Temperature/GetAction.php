<?php

declare(strict_types=1);

namespace App\Http\Action\V1\Temperature;

use App\Http\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GetAction implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $temperature = round((int)shell_exec('cat /sys/class/thermal/thermal_zone0/temp')/1000, 2);
        return new JsonResponse([
            'temperature' => $temperature
        ]);
    }
}