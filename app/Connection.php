<?php

namespace App;

class Connection
{
    private static array $connection = [];

    public static function connection(): array
    {
        if (empty(self::$connection)){

            $readJsonFileContents = file_get_contents("sample.json");
            $getJsonFileContent = json_decode($readJsonFileContents, true);

            self::$connection = $getJsonFileContent;
        }
        return self::$connection;
    }
}