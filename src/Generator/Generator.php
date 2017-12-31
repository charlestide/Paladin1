<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2017/12/25
 * Time: 下午10:35
 */

namespace Charlestide\Paladin\Generator;


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
     * @param $content
     * @param $file
     * @param bool $overwrite
     * @return bool
     */
    protected function writeFile($content, $file,$overwrite = false) {
        if ($overwrite) {
            if (Storage::disk('app')->has($file)) {
                Storage::disk('app')->delete($file);
                $this->put('删除文件: '.$file);
            }
        }

        if (Storage::disk('app')->put($file,$content)) {
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


        $templateFile = app_path('Paladin/Generator/Crud/Templates/'.$templateName.'.blade.php');

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
        $storage = Storage::disk('app');
        $oldContent = $storage->get($file);

        if (strpos($oldContent,trim($content)) === false and
            Storage::disk('app')->append($file,"\n".$content."\n")
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