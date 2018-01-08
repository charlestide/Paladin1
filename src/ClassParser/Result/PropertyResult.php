<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2018/1/8
 * Time: 下午7:15
 */

namespace Charlestide\Paladin\ClassParser\Result;


class PropertyResult {

    /**
     * @var string 显示名
     */
    public $displayName;

    /**
     * @var string 字段类型
     */
    public $type;

    /**
     * @var string 变量名
     */
    public $name;

    /**
     * Property constructor.
     * @param string $name
     * @param string $displayName
     * @param string|null $description
     */
    public function __construct(string $name, string $displayName,string $type)
    {
        $this->name = $name;
        $this->displayName = $displayName;
        $this->type = $type;
    }

}