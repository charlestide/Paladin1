<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2017/12/25
 * Time: 下午10:35
 */

namespace Charlestide\Paladin\Generator;


use Charlestide\Paladin\Storage\FileManager;
use Charlestide\Paladin\Util\StyledOutput;
use Illuminate\Support\Facades\Storage;


/**
 * Class Generator
 * @package App\Paladin\Generator
 */
abstract class Generator
{

    use StyledOutput;

    /**
     * @var FileManager
     */
    protected $filemanager;

    public function __construct()
    {
        $this->filemanager = app(FileManager::class);
    }

    /**
     * @param $content
     * @param $file
     * @param bool $overwrite
     * @return bool
     */
    protected function writeFile($content, $file,$overwrite = false) {
        if ($this->filemanager->has($file)) {
            $this->warn('文件已经存在...',false);
            if ($overwrite) {
                $this->put('尝试覆盖...');
                $this->filemanager->delete($file);
                $this->comment('完成',false);
            } else {
                $this->comment('不覆盖',false);
            }
        }

        if ($this->filemanager->put($file,$content)) {
            return $file;
        } else {
            return false;
        }
    }

    /**
     * @param $templateName
     * @param string $type
     * @param array $data
     * @return string
     */
    protected function readTemplate($templateName, $type = 'plain', array $data = []) {

        $templateFile = __DIR__.'/Crud/Templates/'.$templateName.'.blade.php';
        $fileContent = view()->file($templateFile,$data)->render();

        switch ($type) {
            case 'php':
                $fileContent = "<?php \n".$fileContent;
                break;
            case 'plain':
            default:
        }

        return $fileContent;
    }

    /**
     * @param $content
     * @param $file
     * @return bool
     */
    protected function appendToFile($content, $file) {
        $oldContent = $this->filemanager->get($file,true);

        if (strpos($oldContent,trim($content)) === false and
            $this->filemanager->append($file,"\n".$content."\n")
        ) {
            return $file;
        } else {
            return false;
        }
    }

    /**
     * @param $pattern
     * @param $content
     * @return bool
     */
    protected static function matchFirst($pattern, $content) {
        $result = preg_match($pattern,$content,$matches);
        if ($result and count($matches) > 1) {
            return $matches[1];
        } else {
            return false;
        }
    }
}