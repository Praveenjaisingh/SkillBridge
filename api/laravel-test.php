<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

echo "Starting Laravel...<br>";

try {
    require __DIR__ . '/../vendor/autoload.php';

    echo "Autoload loaded...<br>";

    $app = require_once __DIR__ . '/../bootstrap/app.php';

    echo "Bootstrap loaded...<br>";

    $request = Illuminate\Http\Request::capture();

    echo "Request created...<br>";

    try {
        $response = $app->handleRequest($request);

        echo "Laravel handled request...<br>";

        $response->send();

    } catch (\Throwable $e) {

        echo "<h2>Laravel Request Error</h2>";

        echo "<strong>Type:</strong> " . get_class($e) . "<br>";
        echo "<strong>Message:</strong> " . htmlspecialchars($e->getMessage()) . "<br>";
        echo "<strong>File:</strong> " . $e->getFile() . "<br>";
        echo "<strong>Line:</strong> " . $e->getLine() . "<br>";

        echo "<h3>Stack Trace</h3>";

        echo "<pre>";
        echo htmlspecialchars($e->getTraceAsString());
        echo "</pre>";
    }

} catch (\Throwable $e) {

    echo "<h2>Laravel Bootstrap Error</h2>";

    echo "<strong>Type:</strong> " . get_class($e) . "<br>";
    echo "<strong>Message:</strong> " . htmlspecialchars($e->getMessage()) . "<br>";

    echo "<strong>File:</strong> " . $e->getFile() . "<br>";
    echo "<strong>Line:</strong> " . $e->getLine() . "<br>";

    echo "<pre>";
    echo htmlspecialchars($e->getTraceAsString());
    echo "</pre>";
}