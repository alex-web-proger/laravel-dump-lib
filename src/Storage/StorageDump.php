<?php


namespace Alexlen\DumpLib\Storage;

use Illuminate\Support\Facades\Storage;

class StorageDump
{
    const DEFAULT_DUMP_DIR_NAME = 'dump';
    const DEFAULT_BACKUP_DIR_NAME = 'backup';

    private $dumpDirName;
    private $backupDirName;

    public function __construct()
    {
        $this->dumpDirName = config('alexlendump.dump_dir_name', self::DEFAULT_DUMP_DIR_NAME);
        Storage::makeDirectory($this->dumpDirName);

        $this->backupDirName = config('alexlendump.backup_dir_name', self::DEFAULT_BACKUP_DIR_NAME);
        Storage::makeDirectory($this->dumpDirName . '/' . $this->backupDirName);
    }

    /**
     * Имя файла с полным путем к нему на диске
     */
    public function getFullFilename($filename)
    {
        return storage_path("app/" . $this->dumpDirName) . '/' . $filename;
    }

    public function existsFile($filename)
    {
        return Storage::exists($this->dumpDirName . '/' . $filename);
    }

    public function getBackupDir()
    {
        return $this->backupDirName;
    }

    private function getBackupPath()
    {
        return $this->dumpDirName . '/' . $this->backupDirName . "/";
    }

    public function getBackupFiles()
    {
        $files = Storage::files($this->getBackupPath());
        $result = [];
        if ($files) {
            foreach ($files as $file) {
                $name = $this->getDateTimeFile($file);
                $result[$name['datetime']] = $name['filename'];
            }
        }
        return $result;
    }

    public function delete($filename)
    {
        Storage::delete($this->getBackupPath() . $filename);
    }

    private function getDateTimeFile($file)
    {
        $file = basename($file);
        $params = explode('_', $file);
        $date = $params[0];
        $date = substr_replace($date, ".", 2, 0);
        $date = substr_replace($date, ".", 5, 0);
        $time = $params[1];
        $time = substr_replace($time, ":", 2, 0);
        $time = substr_replace($time, ":", 5, 0);
        $datetime = $date . ' ' . $time . '  ' . $file;
        return [
            'datetime' => $datetime,
            'filename' => $file
        ];
    }

    public function addPathBackup($filename)
    {
        return $this->backupDirName . '/' . $filename;
    }

    public function clearBackup($maxFilesBackUp = false)
    {
        $files = Storage::files($this->getBackupPath());
        if ($maxFilesBackUp && count($files) >= $maxFilesBackUp) {
            $count = count($files) - $maxFilesBackUp;
            for ($i = 0; $i < $count; $i++) {
                Storage::delete($files[$i]);
            }
        }
    }

}
