<?php

if (php_sapi_name() !== 'cli') {
    exit;
}

require __DIR__ . '/vendor/autoload.php';

use Lib\App;



$app = new App();
// $app = new Txt();

/**
 * Keyin the duration of your travel 
 * and the sys will recommend the 2 movies suitable for you.
 * 
 * Key is in hours
 * */ 

$app->registerCommand('duration', function (array $argv) use ($app) {
    $name = isset ($argv[2]) ? $argv[2] : 1;
    $app->movieRecommendation($name);
});

$app->registerCommand('movies', function (array $argv) use ($app) {
    $name = isset ($argv[2]) ? $argv[2] : "movies";
    $app->movieList();
});

$app->registerCommand('help', function (array $argv) use ($app) {
    $app->getPrinter()->display("usage:1 cmd>>php.exe main.php duration  hours");
    $app->getPrinter()->display("usage:2 cmd>>php.exe main.php movies");
    $app->getPrinter()->display("usage:3 cmd>>php.exe main.php help");
});

$app->runCommand($argv);