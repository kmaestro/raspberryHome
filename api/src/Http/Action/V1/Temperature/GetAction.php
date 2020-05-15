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
        try {
            $sh = `sudo python /home/pi/bme280.py 2>&1`;
            preg_match('/Temperature\s*:\s*([^\s]*)\s*/', $sh, $temperatureSensor);
            preg_match('/Pressure\s*:\s*([^\s]*)\s*/', $sh, $pressure);
            preg_match('/Humidity\s*:\s*([^\s]*)\s*/', $sh, $humidity);
        } catch (\Throwable $exception) {
            $temperatureSensor[1] = 0;
            $pressure[1] = 0;
            $humidity[1] = 0;
        }

        $temperature = round((int)shell_exec('cat /sys/class/thermal/thermal_zone0/temp')/1000, 1);
        return new JsonResponse([
            'temperature' => $temperature,
            'temperatureSensor' => round((float)$temperatureSensor[1], 2),
            'pressure' => round((float)$pressure[1], 2),
            'humidity' => round((float)$humidity[1], 2)
        ]);
    }
}
