<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2017/12/23
 * Time: 下午4:08
 */

namespace Charlestide\Paladin\Generator\Crud;

use Charlestide\Paladin\ClassParser\Parser\ModelParser;
use Charlestide\Paladin\ClassParser\Result\PropertyResult;
use Charlestide\Paladin\Generator\Generator;
use Charlestide\Paladin\Storage\FileManager;
use Charlestide\Paladin\Storage\Persistent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

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

    /**
     * @var PropertyResult[]
     */
    protected $columns = [];

    public function __construct(string $modelClass,bool $overwriteFile = false)
    {
        parent::__construct();

        $modelClass = str_replace('/','\\',$modelClass);
        $this->model = new $modelClass;
        $this->modelName = ucfirst(class_basename($modelClass));
        $this->overwriteFile = (boolean)$overwriteFile;
//        $this->loadFromCache();

        $parser = new ModelParser();
        $classResult = $parser->parseClass($modelClass);

        $this->displayName = $classResult->getDisplayName();
        $this->columns = $classResult->getProperties();

    }

    public function run() {
        $this->route();
        $this->controller();
        $this->policy();
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

    /**
     * 写入路由
     */
    public function route() {

        $data = $this->getRenderData();
        $fileContent = $this->readTemplate('route','plain',$data);
        $fileContent = str_replace('___modelName___','{'.camel_case($this->modelName).'}',$fileContent);
        $filePath = 'routes/web.php';

        $this->info('将route写入到'.$filePath.'...',false);

        if ($this->appendToFile($fileContent,$filePath)) {
            $this->comment('写入完成');
        } else {
            $this->comment('路由已存在，无需写入');
        }
    }

    /**
     * 生成controller
     */
    public function controller() {

        $data = $this->getRenderData();

        $fileContent = $this->readTemplate('controller','php',$data);
        $filePath = 'app/Http/Controllers/'.studly_case($this->modelName).'Controller.php';

        $this->info('开始创建controller: '.$filePath,false);

        if ($this->writeFile($fileContent,$filePath,$this->overwriteFile)) {
            $this->comment('已创建Controller: '.$filePath);
        } else {
            $this->error('失败! 创建Controller: '.$filePath);
        }
    }

    /**
     * 生成view
     */
    public function view() {
        $path = 'resources/views/'.camel_case($this->modelName).'/';
        $data = $this->getRenderData();


        foreach (['index','create','update','show'] as $viewName) {
            $filePath = $path.$viewName.'.blade.php';
            $this->info('开始创建view: '.$filePath);

            $filePath = $this->writeFile($this->readTemplate($viewName,'plain',$data),$filePath,$this->overwriteFile);
            if ($filePath) {
                $this->comment('已创建View: '.$filePath);
            } else {
                $this->error('失败！创建View: '.$filePath);
            }

        }
    }

    /**
     * 生成Policy
     */
    public function policy() {

        $modelClassName = get_class($this->model);
        $storage = app(Persistent::class);
        $this->info('正在为 '.$modelClassName.' 创建鉴权策略...',false);

        $data['ModelName'] = studly_case($this->modelName);
        $fileContent = $this->readTemplate('policy','php',$data);
        $filePath = 'app/Policies/'.studly_case($this->modelName).'Policy.php';

        $this->info('开始创建Policy: '.$filePath,false);

        if (!Gate::getPolicyFor($modelClassName)) {
            if ($this->writeFile($fileContent,$filePath,$this->overwriteFile)) {
                $this->comment('已创建Policy: '.$filePath);
            } else {
                $this->error('失败! 创建Policy: '.$filePath);
            }

        } else {
            $this->comment('忽略，已有其他策略');
        }
    }

    /**
     * @return array
     */
    protected function getRenderData() : array {
        $data['model'] = $this->model;
        $data['modelName'] = camel_case($this->modelName);
        $data['ModelName'] = studly_case($this->modelName);
        $data['displayName'] = $this->displayName;
        $data['primaryKey'] = $this->model->getKeyName();
        $data['columns'] = $this->columns;
        return $data;
    }

    /**
     * 存储到缓存中
     */
    protected function saveToCache() {
        Cache::store('file')->forever($this->modelName,[
            'modelDisplayName' => $this->displayName,
            'columns' => $this->columns
        ]);
    }

    /**
     * 从缓存中读取
     */
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
}