<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2017/12/31
 * Time: 下午10:31
 */

namespace Charlestide\Paladin\Storage;


use Illuminate\Support\Facades\Storage;

class Persistent
{

    /**
     * @var string
     */
    private $persistentFile = '';

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var Persistent
     */
    static private $instance;

    /**
     * @return Persistent
     */
    public static function instance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Persistent constructor.
     */
    private function __construct()
    {
        $this->persistentFile = config_path('paladin.storage');
        $this->loadFromDisk();
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name) {
        return $this->data[$name];
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value) {
        $this->data[$name] = $value;
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    /**
     * 从磁盘中读取
     * @return bool
     */
    public function loadFromDisk() {
        $content = Storage::disk('local')->get($this->persistentFile);

        if ($content) {
            $this->data = json_decode($content);
            return true;
        } else {
            return false;
        }
    }

    /**
     * 写入磁盘
     */
    public function saveToDisk() {
        $content = json_encode($this->data);
        Storage::disk('local')->put($this->persistentFile,$content);
    }

}