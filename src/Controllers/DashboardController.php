<?php

namespace Charlestide\Paladin\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Linfo\Linfo;
use Matriphe\Larinfo\LarinfoFacade;
use Probe\ProviderFactory;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index() {


        $mysqlVersion = DB::select('select VERSION() as version');
        if ($mysqlVersion and count($mysqlVersion) > 0) {
            $mysqlVersion = $mysqlVersion[0];
            $mysqlVersion = $mysqlVersion->version;
        }

        $linfo = new Linfo();
        $linfoParser = $linfo->getParser();





        $hardware = LarinfoFacade::getServerInfoHardware();
        $software = LarinfoFacade::getServerInfoSoftware();

        return view('paladin::dashboard.index',[
            'mysqlVersion' => $mysqlVersion,
            'systemInfo' => $linfoParser,
            'memUsage' => $hardware['ram'],
            'diskUsage' => $hardware['disk'],
            'swapUsage' => $hardware['swap'],
            'software' => $software,
            'hardware' => $hardware,
            'uptime' => LarinfoFacade::getUptime()
        ]);
    }

    public function routes() {

        $routes = Route::getRoutes()->getRoutes();

        $routeData = collect();

        foreach ($routes as $route)
            $routeData->push([
                'host'   => $route->domain(),
                'method' => implode('|', $route->methods()),
                'uri'    => $route->uri(),
                'name'   => $route->getName(),
                'action' => $route->getActionName(),
                'middleware' => collect($route->gatherMiddleware())->map(function ($middleware) {
                    return $middleware instanceof Closure ? 'Closure' : $middleware;
                })->implode(',')
            ]);

        return Datatables::collection($routeData)->make(true);
    }

    public function usage() {
        $system = ProviderFactory::create();
        dd($system->getExternalIP());
    }



}
