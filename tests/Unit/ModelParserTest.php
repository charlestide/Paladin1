<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2018/1/8
 * Time: 下午4:54
 */

namespace Charlestide\Paladin\Tests\Unit;

use Charlestide\Paladin\ClassParser\Parser\ModelParser;
use Charlestide\Paladin\Tests\Base\Base;
use Illuminate\Database\Eloquent\Model;

class ModelParserTest extends Base
{

    public function testParsePath()
    {
        $parser = new ModelParser(Model::class,'src/Models');
        $classes = $parser->parsePath();
        $this->assertTrue(is_array($classes));
        $this->assertGreaterThan(0,count($classes));

        $class = array_shift($classes);

        $this->assertEquals('管理员',$class->getDisplayName());

        $properties = $class->getProperties();
        $this->assertGreaterThan(0,count($properties));

        $propertyId = $class->getProperty('id');


        $this->assertEquals('管理员ID',$propertyId->displayName);
    }

    public function testParseFile() {
        $parser = new ModelParser(Model::class);
        $class = $parser->parseFile('src/Models/Admin.php');

        $this->assertEquals('管理员',$class->getDisplayName());

        $properties = $class->getProperties();
        $this->assertGreaterThan(0,count($properties));

        $propertyId = $class->getProperty('id');


        $this->assertEquals('管理员ID',$propertyId->displayName);

    }
}
