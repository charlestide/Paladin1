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
                'disable_asserts' => true,
                'links' => false
        ]);
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->filesystem,$name],$arguments);
    }

    /**
     * 传入过滤条件，过滤内容
     *
     * @example
     *  $this->listFilted(['type'=>'file'])
     *  //列出所有base_path下的文件
     *
     *
     * @param array $conditions
     * @param string|null $path
     * @param bool $recursive
     * @return array
     */
    public function listFilted(array $conditions, string $path = null, bool $recursive = false) : array {
        $contents = $this->listContents($path,$recursive);

        return collect($contents)->filter(function($item,$key) use ($conditions) {
            foreach ($conditions as $key => $value) {
                return isset($item[$key]) ? $item[$key] == $value : false;
            }
        })->toArray();
    }


}