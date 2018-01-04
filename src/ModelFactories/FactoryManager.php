<?php
/**
 * Created by PhpStorm.
 * User: Charles.Tide <charlestide@vip.163.com>
 * Date: 2018/1/4
 * Time: 上午11:39
 */

namespace Charlestide\Paladin\ModelFactories;

use Charlestide\Paladin\Models\Admin;
use Symfony\Component\Finder\Finder;

class FactoryManager
{

    static public function defineAll() {
        foreach (Finder::create()->files()->name('/.+Factory\.php/')->in(__DIR__) as $file) {
            $class = 'Charlestide\Paladin\ModelFactories\\'. str_before($file->getBaseName(),'.php');

            /**
             * @var Factory
             */
            $instance = app($class);
            $instance->define();
        }

    }
}