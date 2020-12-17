<?php

namespace Musement\Tools;

class Printer
{
    public static function message(string $message)
    {
        // TODO: remove
        print_r("<pre>{$message}</pre><br/>");

        fwrite(STDOUT, $message);
    }

    public static function error(string $message, string $prefix = "ERROR")
    {
        self::message("{$prefix}: {$message}");
    }
}