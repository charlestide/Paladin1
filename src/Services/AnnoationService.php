<?php
/**
 * Created by PhpStorm.
 * User: Charles.Tide <charlestide@vip.163.com>
 * Date: 2018/1/4
 * Time: 下午10:37
 */

namespace Charlestide\Paladin\Services;

use Minime\Annotations\Reader;

class AnnoationService
{
    /**
     *
     * @var \Minime\Annotations\Interfaces\ReaderInterface
     */
    private $reader;

    public function __construct()
    {
        $this->reader = Reader::createFromDefaults();
    }

    /**
     * @param $className
     * @param $methodName
     * @param array $annotationNames
     * @return \Minime\Annotations\Interfaces\AnnotationsBagInterface|null
     */
    public function fromMethod($className,$methodName,$annotationNames = []) {

        if (is_string($annotationNames)) {
            $annotationNames = [$annotationNames];
        }

        $misses = [];

        try {
            $annotation =  $this->reader->getMethodAnnotations($className, $methodName);

            foreach ($annotationNames as $annotationName) {
                if (!$annotation->has($annotationName)) {
                    $misses[] = $annotationName;
                }
            }

            if (count($misses)) {
                $parentMethod = $this->getParentMethod($className,$methodName);
                $parentAnnotation = $this->fromMethod($parentMethod->getDeclaringClass(), $methodName, $annotationNames);
                if ($parentAnnotation and $parentAnnotation->count()) {
                    foreach ($misses as $miss) {
                        $annotation->set($miss,$parentAnnotation->get($miss,''));
                    }
                }
            }

            return $annotation;

        } catch (\ReflectionException $exception) {
            return null;
        }
    }

    private function getParentClass($className) {
        $ref = new \ReflectionClass($className);
        return $ref->getParentClass();
    }

    private function getParentMethod($className, $methodName) {
        $ref = new \ReflectionMethod($className,$methodName);
        return $ref->getPrototype();
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return (new static())->$name($arguments);
    }

}