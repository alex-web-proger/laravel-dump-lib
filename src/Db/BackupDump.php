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

        return $this->dump->export($filename);
    }
}
