<?php

namespace Musement\Tools;

class Printer
{
    public static function message(string $message): void
    {
        fwrite(STDOUT, "{$message}\n");
    }

    public static function error(string $message, string $prefix = 'ERROR'): void
    {
        fwrite(STDERR, "{$prefix}\n{$message}\n");
    }
}
