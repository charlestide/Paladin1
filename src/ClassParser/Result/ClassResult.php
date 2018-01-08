<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2018/1/8
 * Time: 下午4:36
 */

namespace Charlestide\Paladin\ClassParser\Result;




class ClassResult
{

    /**
     * @var string
     */
    protected $className;

    /**
     * @var string
     */
    protected $displayName;

    /**
     * @var array
     */
    protected $properties = [];

    /**
     * ParsedResult constructor.
     * @param $className
     */
    public function __construct(string $className,string $displayName = null)
    {
        $this->className = $className;
        $this->displayName = $displayName;
    }

    /**
     * @param PropertyResult $property
     */
    public function addProperty(PropertyResult $property):void {
        $this->properties[$property->name] = $property;
    }

    /**
     * @return string
     */
    public function getClassName(): string
    {
        return $this->className;
    }

    /**
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    /**
     * @return array
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /**
     * @param string $name
     * @return PropertyResult
     */
    public function getProperty(string $name) : ?PropertyResult {
        if (isset($this->properties[$name])) {
            return $this->properties[$name];
        } else {
            return null;
        }
    }


}

