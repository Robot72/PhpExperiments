<?php

use Framework\Http\Request;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$request = new Request();
echo'<pre>'; print_r($request->getCookieParams());die;

$name = $_GET['name'] ?? 'Guest';

header('X-Developer: Robert Kuznetsov');

echo 'hello ' . $name;
