<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2017/12/29
 * Time: 下午9:37
 */

namespace Charlestide\Paladin\Services;

use Charlestide\Paladin\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Minime\Annotations\Interfaces\AnnotationsBagInterface;

class AuthService
{
    private static $exceptPolicyMethods = [
        'before',
        'after',
        'allow',
        'deny'
    ];

    public static function detectPermissions() {
        self::detectDefintions();
        self::detectPolicys();
    }

    /**
     * 检测现有的policy映射，将没有创建权限的映射，创建权限
     */
    public static function detectPolicys() {
        foreach (Gate::policies() as $modelClassName => $policyClassName) {
            self::parsePolicy($modelClassName,$policyClassName);
        }
    }

    public static function detectDefintions() {
        foreach (Gate::abilities() as $defintionName => $function) {
            Permission::firstOrNew(['name' => $defintionName]);
        }
    }

    /**
     * @param $modelClassName
     * @param $policyClassName
     * @return array
     */
    public static function parsePolicy($modelClassName,$policyClassName) {
        $ref = new \ReflectionClass($policyClassName);
        $methods = collect($ref->getMethods())->reject(function ($method) {
            return in_array($method->name,self::$exceptPolicyMethods) || !$method->isPublic() || $method->isStatic();
        });
        $prefix = camel_case(class_basename($modelClassName));

        $permissions = [];
        $methods->each(function($method) use ($policyClassName,&$permissions,$modelClassName) {
            $annotation = (new AnnoationService)->fromMethod(
                $policyClassName,$method->getName()
            );
            $permissions[] = self::createPermission($method,$annotation,$policyClassName,$modelClassName);
        });

        return $permissions;
    }

    /**
     * @param \ReflectionMethod $method
     * @param AnnotationsBagInterface $annotationsBag
     * @param string $policyClassName
     * @return mixed
     */
    public static function createPermission(\ReflectionMethod $method, AnnotationsBagInterface $annotationsBag,string $policyClassName,$object) {
        $object = !is_object($object) ?: get_class($object);
        $permission = Permission::firstOrNew([
            'name' => "$object.{$method->getName()}",
            'action' => $method->getName(),
            'object' => $object,
            'policy' => $policyClassName
        ]);
        $permission->name = $annotationsBag->get('name',$method->name);
        $permission->description = $annotationsBag->get('summary');
        $permission->save();
        return $permission;
    }

    /**
     * @param string $policyClassName
     * @return string
     */
    public static function getModelClassByPolicy(string $policyClassName): string {
         return collect(Gate::policies())->search($policyClassName);
    }

    /**
     * @param string $modelClassName
     * @return string
     */
    public static function getPolicyClassByModel(string $modelClassName):string {
        return collect(Gate::policies())->get($modelClassName);
    }

    public static function createCrudPermission($action)
    {

    }
}