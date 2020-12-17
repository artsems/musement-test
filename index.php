<?php

require_once('vendor/autoload.php');

use \Musement\Kernel;
use \Musement\Tools\Printer;

try {
    (new Kernel())->handle();
} catch (Exception $exception) {
    Printer::error($exception->getMessage(), 'TOP LEVEL ERROR');
}