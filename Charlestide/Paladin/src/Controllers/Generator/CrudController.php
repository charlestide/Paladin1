<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2017/12/25
 * Time: 下午4:45
 */

namespace Charlestide\Paladin\Controllers\Generator;


use App\Http\Controllers\Controller;
use Charlestide\Paladin\Generator\Crud\CrudGenerator;
use Illuminate\Http\Request;

class CrudController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show() {

        $models = CrudGenerator::getAllModels('app/Model');

        return view('generator.crud.show',[
            'models' => $models,
            'modelPath' => 'app/Model',
            'basePath' => base_path(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function model(Request $request) {
        if ($request->has('modelClass')) {
            $crud = new CrudGenerator($request->input('modelClass'));
            return response()->json([
                'modelDisplayName' => $crud->getDisplayName(),
                'columns' => $crud->getColumns(true)
            ]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function run(Request $request) {

        $crud = new CrudGenerator($request->input('modelClass'),$request->input('modelDisplayName'),$request->has('overwriteFile'));
        $crud->setColumnsInfo($request->input('modelColumns'));
        $crud->run();

        return view('generator.crud.result',[
            'modelClass' => $request->input('modelClass'),
            'modelDisplayName' => $request->input('modelDisplayName'),
            'modelColumns' => $request->input('modelColumns'),
            'generatedResult' => $crud->getOutput()->fetch()
        ]);
    }
}