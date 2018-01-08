<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2018/1/8
 * Time: 下午4:42
 */

namespace Charlestide\Paladin\ClassParser\Parser;


use Charlestide\Paladin\ClassParser\Result\ClassResult;
use Charlestide\Paladin\ClassParser\Result\PropertyResult;
use phpDocumentor\Reflection\DocBlock;

class ModelParser extends BaseParser
{

    /**
     * @return iterable
     */
    protected function classes(): iterable
    {
        return $this->scanFiles(null,'.php', [$this, 'getClass']);
    }


    /**
     * @param DocBlock $docBlock
     * @param string $class
     * @return ClassResult
     */
    protected function parse(DocBlock $docBlock,string $class) : ClassResult {
        $docBlock->getTagsByName('displayName');

        $classResult = new ClassResult(
            $class,
            $this->getTag($docBlock,'displayName')
        );

        $properties = $docBlock->getTagsByName('property');

        if (is_iterable($properties)) {
            foreach ($properties as $property) {

                $propertyResult = new PropertyResult(
                    $property->getVariableName(),
                    $property->getDescription(),
                    $property->getType()
                );

                $classResult->addProperty($propertyResult);
            }
        }

        return $classResult;
    }


    /**
     * 获取单个注释tag
     * @param DocBlock $doc
     * @param string $name
     * @return DocBlock\Tags\Generic
     */
    protected function getTag(DocBlock $doc, string $name) : ?DocBlock\Tags\Generic {
        if ($doc->hasTag($name)) {
            return $doc->getTagsByName($name)[0];
        } else {
            return null;
        }
    }


//    public function getColumns(Model $model, $compareWithDb = false) {
//            $schemaBuilder = $model->getConnection()->getSchemaBuilder();
//            $tableName = $model->getTable();
//            $primaryKey = $model->getKeyName();
//
//            foreach ($schemaBuilder->getColumnListing($tableName) as $columnName) {
//
//                //类型
//                $this->columns[$columnName]['type'] = $schemaBuilder->getColumnType($tableName, $columnName);
//
//                //显示名称
//                if (!isset($this->columns[$columnName]['displayName']) and empty($this->columns[$columnName]['displayName'])) {
//                    $displayName = $columnName;
//                    switch ($columnName) {
//                        case 'created_at':
//                            $displayName = '创建于';
//                            break;
//                        case 'updated_at':
//                            $displayName = '更新于';
//                            break;
//                        case 'id':
//                            $displayName = 'ID';
//                    }
//
//                    $this->columns[$columnName]['displayName'] = $displayName;
//                }
//
//                //是否主键
//                $this->columns[$columnName]['primary'] = $columnName == $primaryKey;
//            }
//
//            $this->saveToCache();
//        }
//
//        return $this->columns;
//    }

}