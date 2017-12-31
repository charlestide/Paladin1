<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2018/1/1
 * Time: 上午1:11
 */

namespace Charlestide\Paladin\Storage;


use Illuminate\Filesystem\FilesystemManager;

class FileManager
{

    /**
     * @var \Illuminate\Contracts\Filesystem\Filesystem
     */
    private $filesystem;


    public function __construct(FilesystemManager $filesystemManager) {
         $this->filesystem = $filesystemManager->createLocalDriver([
                'drive' => 'local',
                'root' => base_path(),
                'disable_asserts' => true
        ]);
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->filesystem,$name],$arguments);
    }
}