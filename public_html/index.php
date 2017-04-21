<?php
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

if (ini_get('session.save_handler') == "files") {
    ini_set('session.save_path', realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
}
session_start();

function session($key = null, $default = null)
{
    if (is_array($key)) {
        foreach ($key as $index => $item) {
            $_SESSION[$index] = $item;
        }

        return true;
    }

    if (!isset($_SESSION[$key])) {
        return $default;
    }

    return $_SESSION[$key];
}

$app = require __DIR__.'/../bootstrap/app.php';
$app->run();
