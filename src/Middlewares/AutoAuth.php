<?php

namespace Charlestide\Paladin\Middlewares;

use Charlestide\Paladin\Services\AuthService;
use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class AutoAuth
{

    private $controllerToPolicyMaps = [
        'show' => 'view',
        'store' => 'create',
        'destroy' => 'delete',
        'edit' => 'update'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  array $maps
     * @return mixed
     */
    public function handle($request, Closure $next, array $maps = [])
    {

        $route = Route::current();
        $controller = $route->getController();

        //要使用此中间件，需要在controller中定义getAuthModel方法，并返回一个Model类名
        if (method_exists($controller,'getAuthModel') and $controller->getAuthModel()) {

            $this->controllerToPolicyMaps = array_merge($this->controllerToPolicyMaps,$maps);

            /**
             * 从路由中获取第一个model
             * @var Model
             */
            $model = $this->getFirstRouteModel($controller->getAuthModel());

            /**
             * 获取policy中对应方法的反射对象
             * @var \ReflectionMethod
             */
            $policyMethod = $this->getPolicyMethod(
                $controller->getAuthModel(),
                $this->getControllerMethod()
            );

            if ($policyMethod) {
                //如果policy中的方法的参数少于2个，则表示不用传入model实例，用model类名代替
                if ($policyMethod->getNumberOfParameters() < 2) {
                    $controller->authorize($policyMethod->getName(),$controller->getAuthModel());
                } else if ($model) {
                    $controller->authorize($policyMethod->getName(), $model);
                }
            }
        }
        return $next($request);
    }

    /**
     * @param $modelClass
     * @return bool
     */
    protected function getFirstRouteModel($modelClass) {
        $route = Route::current();

        foreach ($route->parameters() as $param) {
            if (is_a($param,$modelClass)) {
                return $param;
            }
        }
        return false;
    }

    /**
     * @return mixed
     */
    protected function getControllerMethod() {
        return Str::parseCallback(Route::currentRouteAction())[1];
    }

    /**
     * @param $modelClassName
     * @param $method
     * @return bool|mixed
     */
    protected function getPolicyMethod($modelClassName,$method) {
        if (empty($modelClassName) or empty($method)) {
            return false;
        }

        $policyClassName = AuthService::getPolicyClassByModel($modelClassName);

        $policyMethods = get_class_methods($policyClassName);

        if (isset($this->controllerToPolicyMaps[$method])) {
            $method = $this->controllerToPolicyMaps[$method];
        }

        if (is_array($policyMethods) and in_array($method,$policyMethods)) {
            return new \ReflectionMethod($policyClassName,$method);
        } else {
            return false;
        }
    }
 }
