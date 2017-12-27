<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2017/12/23
 * Time: 下午9:45
 */

namespace App\Paladin\Generator;


trait hasSchema
{

//    protected $schema = [];

    public function getSchema() {
        return $this->schema;
    }

}