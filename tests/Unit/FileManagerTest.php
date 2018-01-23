<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2018/1/8
 * Time: 下午2:54
 */

namespace Charlestide\Paladin\Tests\Unit;

use Charlestide\Paladin\Storage\FileManager;
use Charlestide\Paladin\Tests\Base\Base;

class FileManagerTest extends Base
{

    public function test__construct()
    {
        $fs = app(FileManager::class);
        $file = $fs->get('composer.json');
        $this->assertJson($file,'try to read composer.json and return is not json data');

        $files = $fs->files();
        $file = collect($files)->random(1)->first();
        $this->assertFileExists(base_path($file),'file is not exist: '.$file);

        $dirs = $fs->directories();
        $dir = collect($dirs)->random(1)->first();
        $this->assertFileExists(base_path($dir));
        $this->assertDirectoryExists(base_path($dir),'dir is not exist: '.$dir);
    }
}
