<?php

require_once('vendor/autoload.php');

use \Musement\Kernel;
use \Musement\Tools\Printer;

try {
    echo 'run "echo | php index.php"';

    (new Kernel())->handle();
} catch (Exception $exception) {
    Printer::error($exception->getMessage(), 'TOP LEVEL ERROR');
    Printer::error($exception->getTraceAsString(), 'STACK TRACE');
}