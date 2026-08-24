<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

try {
    require __DIR__ . '/../vendor/autoload.php';

    echo "Autoload loaded<br>";

    $app = require_once __DIR__ . '/../bootstrap/app.php';

    echo "Bootstrap loaded<br>";

    // Check important container bindings BEFORE handling request
    echo "Checking view binding...<br>";

    if ($app->bound('view')) {
        echo "VIEW BINDING EXISTS<br>";
    } else {
        echo "VIEW BINDING DOES NOT EXIST<br>";
    }

    echo "Checking config...<br>";

    echo "APP_ENV: " . config('app.env') . "<br>";
    echo "APP_DEBUG: " . (config('app.debug') ? 'true' : 'false') . "<br>";
    echo "APP_KEY: " . (config('app.key') ? 'SET' : 'NOT SET') . "<br>";

    echo "Creating request...<br>";

    $request = Illuminate\Http\Request::capture();

    echo "Request created<br>";

    echo "Handling request...<br>";

    $response = $app->handleRequest($request);

    echo "Request handled successfully<br>";

    $response->send();

} catch (\Throwable $e) {

    echo "<hr>";
    echo "<h2>ACTUAL ERROR</h2>";

    echo "<strong>Type:</strong> " .
        htmlspecialchars(get_class($e)) . "<br>";

    echo "<strong>Message:</strong> " .
        htmlspecialchars($e->getMessage()) . "<br>";

    echo "<strong>File:</strong> " .
        htmlspecialchars($e->getFile()) . "<br>";

    echo "<strong>Line:</strong> " .
        $e->getLine() . "<br>";

    echo "<h3>Trace</h3>";

    echo "<pre>";
    echo htmlspecialchars($e->getTraceAsString());
    echo "</pre>";
}