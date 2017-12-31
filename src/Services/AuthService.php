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

    public static function detectPolicys() {
        foreach (Gate::policies() as $modelClassName => $policyClassName) {
            self::parsePolicy($modelClassName,$policyClassName);
        }
    }

    public static function detectDefintions() {
        foreach (Gate::abilities() as $defintionName => $function) {
            Permission::firstOrCreate(['name' => $defintionName]);
        }
    }

    protected static function parsePolicy($modelClassName,$policyClassName) {
        $ref = new \ReflectionClass($policyClassName);
        $methods = collect($ref->getMethods())->reject(function ($method) {
            return in_array($method->name,self::$exceptPolicyMethods) || !$method->isPublic() || $method->isStatic();
        });
        $prefix = camel_case(class_basename($modelClassName));

        foreach ($methods as $method) {
            $permission = Permission::firstOrCreate(['name' => $prefix.'.'.$method->name]);
            $permission->policy = $prefix.'@'.$method->name;
            $permission->save();
        }
    }

    public static function getModelClassByPolicy($policyClassName) {
         return collect(Gate::policies())->search($policyClassName);
    }

    public static function getPolicyClassByModel($modelClassName) {
        return collect(Gate::policies())->get($modelClassName);
    }
}