<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2017/12/23
 * Time: 下午4:08
 */

namespace Paladin\Generator\Crud;

use Illuminate\Database\Eloquent\Model;

class CrudGenerator
{

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelName;

    public function __construct($modelClass)
    {
        $this->model = new $modelClass;
        $this->modelName = ucfirst(class_basename($modelClass));
    }

    public function run() {
        $this->route();
    }


    public function route() {
        echo $this->modelName;
    }



}