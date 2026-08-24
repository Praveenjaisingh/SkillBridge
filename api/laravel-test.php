<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

echo "Starting Laravel...<br>";

require __DIR__ . '/../vendor/autoload.php';

echo "Autoload loaded...<br>";

$app = require_once __DIR__ . '/../bootstrap/app.php';

echo "Bootstrap loaded...<br>";

$request = Illuminate\Http\Request::capture();

echo "Request created...<br>";

$response = $app->handleRequest($request);

echo "Laravel handled request...<br>";

$response->send();