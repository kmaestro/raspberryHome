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
    return 'CPU=' . number_format($cpu/1000, 2);
}

$gtk = Gtk::getInstance();
$gtk->init();

$window = new Window();
$window->fullscreen();
$window->setTitle('test');
$window->setSize(500, 100);

$signal = new Signal();
$signal->connect($window, 'destroy', [$gtk, 'mainQuit'], null);

$container = new Container();

$clockLabel = new Label(date('H:i:s'));
$cpuLabel = new Label(tmpCPU());
$temperatureLabel = new Label('temperature');
$pressureLabel = new Label('pressure');
$humidityLabel = new Label('humidity');

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
$i = 0;
$gtk->g_timeout_add(1000, function () use ($cpuLabel, $clockLabel, &$i) {
    $cpuLabel->setText(tmpCPU());
    $clockLabel->setText(date('H:i:s'));
    $i++;
    $clockLabel->setWidthChars($i);
    return true;
}, null);

$gtk->main();


