<?php


namespace Alexlen\DumpLib\Db;


use Alexlen\DumpLib\Helpers\FilenameHelper;
use Alexlen\DumpLib\Storage\StorageDump;

class BackupDump
{
    /**
     * @var Dump
     */
    private $dump;

    public function __construct(Dump $dump)
    {
        $this->dump = $dump;
    }

    public function backup($filename = false)
    {
        $storage = new StorageDump();

        $backupDir = $storage->getBackupDir();

        $filename = "$backupDir/" . FilenameHelper::backupFilename($filename);

        if ($res = $this->dump->export($filename)) {
            $storage->clearBackup(config('alexlendump.backup_max_count_files', 10));
        }

        return $res;

    }
}
