<?php
/**
 * Created by PhpStorm.
 * User: Charles.Tide <charlestide@vip.163.com>
 * Date: 2018/1/4
 * Time: 上午1:05
 */

namespace Charlestide\Paladin\ModelFactories;

use Illuminate\Database\Eloquent\Factory as ModelFactory;

abstract class Factory
{

    /**
     *
     * @var ModelFactory
     */
    protected $factory;

    public function __construct(ModelFactory $factory)
    {
        $this->factory = $factory;
    }

    abstract function define();
}