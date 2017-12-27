<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2017/12/25
 * Time: 下午4:45
 */

namespace app\Http\Controllers\Generator;


use App\Http\Controllers\Controller;
use App\Paladin\Generator\Crud\CrudGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CrudController extends Controller
{

    public function show() {

        $models = CrudGenerator::getAllModels('app/Model');

        return view('generator.crud.show',[
            'models' => $models,
        ]);
    }

    public function model(Request $request) {
        if ($request->has('modelClass')) {
            $crud = new CrudGenerator($request->input('modelClass'));
            return response()->json([
                'modelDisplayName' => $crud->getDisplayName(),
                'columns' => $crud->getColumns(true)
            ]);
        }
    }

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