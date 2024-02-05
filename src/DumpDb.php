<?php


namespace Alexlen\DumpLib;


use Alexlen\DumpLib\Db\BackupDump;
use Alexlen\DumpLib\Db\Dump;

class DumpDb
{

    public static function export($filename, $table = '')
    {
        return self::dump()->export($filename, $table);
    }

    public static function import($filename)
    {
        $dump = new Dump();
        $backup = new BackupDump($dump);
        if (!$backup->backup()) {
            return false;
        }
        return $dump->import($filename);
    }

    public static function backup($filename = false)
    {
        $backup = new BackupDump(self::dump());
        return $backup->backup($filename);
    }

    private static function dump():Dump
    {
        return new Dump();
    }
}
