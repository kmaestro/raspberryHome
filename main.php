<?php
require __DIR__ . '/vendor/autoload.php';

use Gtk3\Gtk;

use Gtk3\Gtk\Window;
use Gtk3\Gtk\Signal;
use Gtk3\Gtk\Container;
use Gtk3\Gtk\Label;
use Gtk3\Gtk\Box;

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
$cpuLabel = new Label('');

$hbox = new Box(Box::GTK_ORIENTATION_HORIZONTAL, 5);
$vbox = new Box(Box::GTK_ORIENTATION_VERTICAL, 10);

$vbox->packStart($cpuLabel, true, false, 5);
$vbox->packStart($clockLabel, true, false, 5);

$hbox->packStart($vbox, true, false, 5);

$container->add($window, $hbox);

$window->showAll();

$gtk->g_timeout_add(1000, function () use ($cpuLabel, $clockLabel) {
    $cpu = (int)file_get_contents('/sys/class/thermal/thermal_zone0/temp');
    $cpuLabel->setText('CPU=' . number_format($cpu/1000, 2));
    $clockLabel->setText(date('H:i:s'));
    return true;
}, null);

$gtk->main();


