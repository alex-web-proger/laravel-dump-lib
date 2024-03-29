<?php


namespace Alexlen\DumpLib\Helpers;


use Illuminate\Support\Str;

class FilenameHelper
{
    public static function backupFilename($name = false, $separator = '_')
    {
        if ($name) {
            $name = str_replace('.sql', '', $name);
            $name = str_replace('.', '', $name);
        } else {
            $name = self::appName(false, $separator);
        }

        $params = [
            'prefix' => date("dmY{$separator}His"),
            'name' => $name,
            'suffix' => 'backup.sql'
        ];
        return implode($separator, $params);
    }

    public static function appName($name = false, $separator = '_')
    {
       $name = $name ? $name . $separator : '';
       return $name . Str::slug(config('app.name'));
    }
}
