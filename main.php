<?php
require __DIR__ . '/vendor/autoload.php';

use Gtk3\Gtk;

use Gtk3\Gtk\Window;
use Gtk3\Gtk\Signal;
use Gtk3\Gtk\Container;
use Gtk3\Gtk\Label;
use Gtk3\Gtk\Box;

function tmpCPU()
{
    $cpu = $cpu = (int)file_get_contents('/sys/class/thermal/thermal_zone0/temp');
    return 'CPU:' . number_format($cpu/1000, 2);
}

$gtk = Gtk::getInstance();
$gtk->init();

$window = new Window();
$window->setTitle('test');
$window->fullscreen();

$signal = new Signal();
$signal->connect($window, 'destroy', [$gtk, 'mainQuit'], null);

$container = new Container();

$clockLabel = new Label(date('H:i:s'));
$cpuLabel = new Label(tmpCPU());
$temperatureLabel = new Label('Temperature: 0');
$pressureLabel = new Label('Pressure: 0');
$humidityLabel = new Label('Humidity: 0');

$hbox = new Box(Box::GTK_ORIENTATION_HORIZONTAL, 5);
$vbox = new Box(Box::GTK_ORIENTATION_VERTICAL, 10);


$hbox->packStart($cpuLabel, true, false, 5);
$hbox->packStart($temperatureLabel, true, false, 5);
$hbox->packStart($pressureLabel, true, false, 5);
$hbox->packStart($humidityLabel, true, false, 5);

$vbox->packStart($hbox, true, false, 5);
$vbox->packStart($clockLabel, true, false, 5);

$container->add($window, $vbox);

$window->showAll();
$gtk->g_timeout_add(1000, function () use ($cpuLabel, $clockLabel) {
    $cpuLabel->setText(tmpCPU());
    $clockLabel->setText(date('H:i:s'));
    return true;
}, null);

$gtk->g_timeout_add(5000, function () use ($temperatureLabel, $pressureLabel, $humidityLabel){
    try {
        $sh = `python ./bme280.py 2>&1`;
        preg_match('/Temperature\s*:\s*([^\s]*)\s*/', $sh, $temperatureSensor);
        preg_match('/Pressure\s*:\s*([^\s]*)\s*/', $sh, $pressure);
        preg_match('/Humidity\s*:\s*([^\s]*)\s*/', $sh, $humidity);
    } catch (Throwable $exception) {
        $temperatureSensor[1] = 0;
        $pressure[1] = 0;
        $humidity[1] = 0;
    }

    $temperatureLabel->setText('Temperature: ' . round((float)$temperatureSensor[1], 2));
    $pressureLabel->setText('Pressure: ' . round((float)$pressure[1], 2));
    $humidityLabel->setText('Humidity: ' . round((float)$humidity[1], 2));
}, null);

$gtk->main();


