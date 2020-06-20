<?php
require __DIR__ . '/vendor/autoload.php';

use Gtk3\Gtk;

use Gtk3\Gtk\Window;
use Gtk3\Gtk\Signal;
use Gtk3\Gtk\Container;
use Gtk3\Gtk\Label;
use Gtk3\Gtk\Grid;

$gtk = Gtk::getInstance();
$gtk->init();

$window = new Window();
$window->fullscreen();
$window->setTitle('test');
$window->setSize(500, 100);

$signal = new Signal();
$signal->connect($window, 'destroy', [$gtk, 'mainQuit'], null);

$container = new Container();

$label = new Label(date('H:i:s'));
$label2 = new Label('');

$grid = new Grid();
$grid->attach($label2, 0, 1,1,1);
$grid->attach($label, 0, 2,1,1);

$container->add($window, $grid);

$window->showAll();

$gtk->g_timeout_add(2000, function () use ($label, $label2) {
    $cpu = (int)file_get_contents('/sys/class/thermal/thermal_zone0/temp');
    $label2->setText('CPU=' . number_format($cpu/1000, 2));
    $label->setText(date('H:i:s'));
    return true;
}, null);

$gtk->main();


