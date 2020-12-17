<?php

namespace Musement\Tools;

class Printer
{
    private static $stdout;

    public static function message(string $message)
    {
        if (is_null(self::$stdout)) {
            self::$stdout = fopen('php://stdout', 'w');
        }

        fwrite(self::$stdout, "{$message}\n");
    }

    public static function error(string $message, string $prefix = 'ERROR')
    {
        self::message("{$prefix}\n{$message}");
    }
}