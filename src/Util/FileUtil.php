<?php

namespace Tool\Util;

class FileUtil
{
    public static function parseFileToArray($filePath)
    {
        $fileString = file_get_contents($filePath);
        return json_decode($fileString,true);
    }
}