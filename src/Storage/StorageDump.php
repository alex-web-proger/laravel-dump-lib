<?php


namespace Alexlen\DumpLib\Storage;

use Illuminate\Support\Facades\Storage;

class StorageDump
{
    const STORAGE_DIR_NAME = 'dump';
    const STORAGE_BACKUP_DIR_NAME = 'backup';

    public function __construct()
    {
        Storage::makeDirectory(self::STORAGE_DIR_NAME);
    }

    /**
     * Имя файла с полным путем к нему на диске
     */
    public function getFullFilename($filename)
    {
        return storage_path("app/" . self::STORAGE_DIR_NAME) . '/' . $filename;
    }

    public function existsFile($filename)
    {
        return Storage::exists(self::STORAGE_DIR_NAME . '/' . $filename);
    }

    public function getBackupDir()
    {
        Storage::makeDirectory($this->getBackupPath());
        return self::STORAGE_BACKUP_DIR_NAME;
    }

    private function getBackupPath()
    {
        return self::STORAGE_DIR_NAME . "/" . self::STORAGE_BACKUP_DIR_NAME . "/";
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
        return self::STORAGE_BACKUP_DIR_NAME . '/' . $filename;
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
