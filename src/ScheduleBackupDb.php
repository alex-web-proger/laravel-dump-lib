<?php

namespace Alexlen\DumpLib;

use Alexlen\DumpLib\Db\BackupDump;
use Alexlen\DumpLib\Db\Dump;
use Alexlen\DumpLib\Helpers\FilenameHelper;

/**
 * Class ScheduleBackupDb
 * @package Alexlen\DumpLib
 */
class ScheduleBackupDb
{
    public function __invoke()
    {
       $backup = new BackupDump(new Dump());

       $filename = FilenameHelper::appName('schedule');

       $backup->backup($filename);
    }
}
