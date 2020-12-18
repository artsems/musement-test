<?php

namespace Musement\Tools;

class Printer
{
    public static function message(string $message)
    {
        fwrite(STDOUT, "{$message}\n");
    }

    public static function error(string $message, string $prefix = 'ERROR')
    {
        fwrite(STDERR, "{$prefix}\n{$message}\n");
    }
}