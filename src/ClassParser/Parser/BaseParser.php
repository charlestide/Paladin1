<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2018/1/8
 * Time: 下午2:41
 */

namespace Charlestide\Paladin\ClassParser\Parser;


use Charlestide\Paladin\ClassParser\Result\ClassResult;
use Charlestide\Paladin\Storage\FileManager;
use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlockFactory;

abstract class BaseParser
{

    /**
     * @var string 父类
     */
    protected $parentClass;

    /**
     * @var string 寻找路径
     */
    protected $path;

    /**
     * BaseParser constructor.
     * @param string $class 类名
     * @param string|null $path 寻找的路径,相对于base_path()
     */
    public function __construct(string $parentClass = null,string $path = null)
    {
        $this->parentClass = $parentClass;
        $this->path = $path ?: base_path();
    }


    /**
     * @param string|null $path
     * @return ClassResult[]
     */
    public function parsePath(string $path = null): iterable
    {
        $this->setPath($path);
        $classes = $this->classes();

        $result = [];
        if (is_iterable($classes)) {
            foreach ($classes as $class) {
                if ($this->isSubClass($class,$this->parentClass)) {
                    $phpdoc = $this->getPHPDoc($class);
                    if ($classResult = $this->parse($phpdoc,$class)) {
                        $result[] = $classResult;
                    }
                }
            }
        }

        return $result;
    }

    /**
     * @param string $file
     * @return ClassResult
     */
    public function parseFile(string $file) : ClassResult {
        $class = $this->getClass($file);
        $phpdoc = $this->getPHPDoc($class);
        return $this->parse($phpdoc,$class);
    }

    /**
     * @param string $class
     * @return ClassResult
     */
    public function parseClass(string $class): ClassResult {
        $phpdoc = $this->getPHPDoc($class);
        return $this->parse($phpdoc,$class);
    }


    /**
     * 扫描文件，如果传入$callback 则每个搜索出来的文件都传入callback之后再返回
     * 返回最终的文件列表，或callback返回的结果的列表
     *
     * @param string|null $startWith 文件名必须匹配的开始的字符
     * @param string|null $endWith 文件名必须匹配的结束的字符
     * @param callable|null $callback
     * @return array
     */
    protected function scanFiles(string $startWith = null,string $endWith = null,callable $callback = null): array {
        $filemanager = app(FileManager::class);
        $files = $filemanager->files($this->path);

        $result = [];
        foreach ($files as $file) {

            if ($startWith) {
                if (!starts_with($file,$startWith)) {
                    continue;
                }
            }

            if ($endWith) {
                if (!ends_with($file,$endWith)) {
                    continue;
                }
            }

            if ($callback) {
                if ($r = $callback($file)) {
                    $result[] = $r;
                }
            } else {
                $result[] = $file;
            }
        }

        return $result;
    }

    /**
     * 获取一个文件的类名（包含命令空间)
     * @param string $file
     * @return string
     */
    protected function getClass(string $file): string {
        $filemanager = app(FileManager::class);
        $fileContent = $filemanager->read($file);
        $namespace = self::matchFirst('/\bnamespace\b[\s]+([\w\\\\]+);/i',$fileContent);
        $class = self::matchFirst('/\bclass\b[\s]+([\w]+)/i',$fileContent);
        if ($namespace and $class) {
            return  $namespace.'\\'.$class;
        } else {
            return null;
        }
    }

    /**
     * @param $pattern
     * @param $content
     * @return string
     */
    protected static function matchFirst(string $pattern, string $content): string {
        preg_match($pattern,$content,$matches);
        if (is_array($matches) and count($matches) > 1) {
            return $matches[1];
        } else {
            return false;
        }
    }

    /**
     * @param string $class
     * @return DocBlock
     */
    protected function getPHPDoc(string $class): DocBlock {
        $refClass = new \ReflectionClass($class);
        $classComment = $refClass->getDocComment();
        $docBlockFactory = DocBlockFactory::createInstance();
        return $docBlockFactory->create($classComment);
    }

    /**
     * @param string|null $path
     */
    public function setPath(string $path = null): void
    {
        if ($path) {
            $this->path = $path;
        }
    }

    /**
     * @param string $class
     * @param string $parentClass
     * @return bool
     */
    protected function isSubClass(string $class,string $parentClass) : bool {
        if (is_a($class,$parentClass)) {
            return true;
        }

        while ($parent = get_parent_class($class)) {
            if ($parent == $parentClass) {
                return true;
            } else {
                $class = $parent;
            }
        }

        return false;
    }

    /**
     * @param DocBlock $docBlock
     * @param string $class
     * @return ClassResult
     */
    abstract protected function parse(DocBlock $docBlock,string $class): ClassResult;


    /**
     * @return iterable
     */
    abstract protected function classes() : iterable;
}