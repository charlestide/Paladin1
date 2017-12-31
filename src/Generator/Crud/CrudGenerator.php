<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2017/12/23
 * Time: 下午4:08
 */

namespace Charlestide\Paladin\Generator\Crud;

use Charlestide\Paladin\Generator\Generator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class CrudGenerator extends Generator
{

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelName;

    /**
     * @var string
     */
    protected $displayName;

    /**
     * @var bool
     */
    protected $overwriteFile = false;

    protected $columns = [];


    public function __construct($modelClass,$displayName = null,$overwriteFile = false)
    {
        $modelClass = str_replace('/','\\',$modelClass);
        $this->model = new $modelClass;
        $this->modelName = ucfirst(class_basename($modelClass));
        $this->overwriteFile = (boolean)$overwriteFile;
        $this->loadFromCache();
        if ($displayName) {
            $this->displayName = $displayName;
        }
    }

    public function run() {
        $this->route();
        $this->controller();
        $this->view();
        $this->saveToCache();
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }


    public function route() {
        $data['model'] = $this->model;
        $data['modelName'] = camel_case($this->modelName);
        $data['ModelName'] = studly_case($this->modelName);

        $fileContent = $this->readTemplate('route','plain',$data);
        $filePath = 'routes/web.php';
        if ($this->appendToFile($fileContent,$filePath)) {
            $this->put('已写入Route: ' . $filePath);
        } else {
            $this->error('无需写入: '.$filePath);
        }
    }

    public function controller() {
        $data['model'] = $this->model;
        $data['modelName'] = camel_case($this->modelName);
        $data['ModelName'] = studly_case($this->modelName);
        $data['displayName'] = $this->displayName;

        $fileContent = $this->readTemplate('controller','php',$data);
        $filePath = 'app/Http/Controllers/'.studly_case($this->modelName).'Controller.php';

        if ($this->writeFile($fileContent,$filePath,$this->overwriteFile)) {
            $this->put('已创建Controller: '.$filePath);
        } else {
            $this->error('失败! 创建Controller: '.$filePath);
        }
    }

    public function view() {
        $path = 'resources/views/'.camel_case($this->modelName).'/';

        $data['model'] = $this->model;
        $data['modelName'] = camel_case($this->modelName);
        $data['ModelName'] = studly_case($this->modelName);
        $data['displayName'] = $this->displayName;
        $data['fields'] = $this->getColumns();
        $data['primaryKey'] = $this->model->getKeyName();

        foreach (['index','create','update','show'] as $viewName) {
            $filePath = $this->writeFile($this->readTemplate($viewName,'plain',$data),$path.$viewName.'.blade.php',$this->overwriteFile);
            if ($filePath) {
                $this->put('已创建View: '.$filePath);
            }

        }
    }

    public function setDisplayName($columnaName,$displayName = null) {
        if ($displayName) {
            $this->columns[$columnaName] = $displayName;
        } else {
            $this->displayName = $columnaName;
        }
    }

    public function setColumnsInfo(array $columnsInfo) {
        foreach ($columnsInfo as $columnName => $columnInfo) {
            $this->columns[$columnName]['displayName'] = $columnInfo['displayName'];
        }
    }

    public function getColumns($compareWithDb = false) {
        if (empty($this->columns) or $compareWithDb) {
            $schemaBuilder = $this->model->getConnection()->getSchemaBuilder();
            $tableName = $this->model->getTable();
            $primaryKey = $this->model->getKeyName();

            foreach ($schemaBuilder->getColumnListing($tableName) as $columnName) {

                //类型
                $this->columns[$columnName]['type'] = $schemaBuilder->getColumnType($tableName, $columnName);

                //显示名称
                if (!isset($this->columns[$columnName]['displayName']) and empty($this->columns[$columnName]['displayName'])) {
                    $displayName = $columnName;
                    switch ($columnName) {
                        case 'created_at':
                            $displayName = '创建于';
                            break;
                        case 'updated_at':
                            $displayName = '更新于';
                            break;
                        case 'id':
                            $displayName = 'ID';
                    }

                    $this->columns[$columnName]['displayName'] = $displayName;
                }

                //是否主键
                $this->columns[$columnName]['primary'] = $columnName == $primaryKey;
            }

            $this->saveToCache();
        }

        return $this->columns;
    }

    protected function saveToCache() {
        Cache::store('file')->forever($this->modelName,[
            'modelDisplayName' => $this->displayName,
            'columns' => $this->columns
        ]);
    }

    protected function loadFromCache() {
        if (Cache::store('file')->has($this->modelName)) {
            $cacheData = Cache::store('file')->get($this->modelName);
            if (isset($cacheData['modelDisplayName'])) {
                $this->displayName = $cacheData['modelDisplayName'];
            }

            if (isset($cacheData['columns'])) {
                $this->columns = $cacheData['columns'];
            }
        }
    }


    public static function getAllModels($modelPath) {
        $files = Storage::disk('app')->listContents($modelPath);
        $models = [];

        foreach ($files as $file) {
            $fileContent = Storage::disk('app')->read($file['path']);
            $namespace = self::matchFirst('/\bnamespace\b[\s]+([\w\\\\]+);/i',$fileContent);
            $class = self::matchFirst('/\bclass\b[\s]+([\w]+)/i',$fileContent);
            if ($namespace and $class) {
                $models[] = $namespace.'\\'.$class;
            }
        }

        return $models;
    }





}