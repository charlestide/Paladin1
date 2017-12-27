namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use {{get_class($model)}};

class {{$ModelName}}Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->input('format') == 'json') {

            ${{$modelName}}s = {{$ModelName}}::query();

            return Datatables::of(${{$modelName}}s)->make(true);
        }

        return view('{{$modelName}}/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('{{$modelName}}/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('{{$modelName}}')) {

            ${{$modelName}}Data = $request->input('{{$modelName}}');

            ${{$modelName}} = new {{$ModelName}}(${{$modelName}}Data);

            ${{$modelName}}->save();

            return redirect('/{{$modelName}}/'.${{$modelName}}->id)->with('messageInfo',['title' => '保存信息', 'text' => '保存成功']);
        } else {
            return redirect()->back()->with('messageInfo',['title' => '错误', 'text' => '错误的提交']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  {{$ModelName}}  ${{$modelName}}
     * @return \Illuminate\Http\Response
     */
    public function show({{$ModelName}} ${{$modelName}})
    {
        return view('{{$modelName}}.show',['{{$modelName}}' => ${{$modelName}}]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  {{$ModelName}}  ${{$modelName}}
     * @return \Illuminate\Http\Response
     */
    public function edit({{$ModelName}} ${{$modelName}})
    {
        return view('{{$modelName}}/update',['{{$modelName}}' => ${{$modelName}}]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  {{$ModelName}}  ${{$modelName}}
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, {{$ModelName}} ${{$modelName}})
    {
        if ($request->has('{{$modelName}}')) {

            ${{$modelName}}Data = $request->input('{{$modelName}}');
            ${{$modelName}}->fill(${{$modelName}}Data);

            ${{$modelName}}->save();

            return redirect('/{{$modelName}}/'.${{$modelName}}->id)->with('messageInfo',['title' => '保存信息', 'text' => '保存成功']);
        } else {
            return redirect()->back()->with('messageInfo',['title' => '错误', 'text' => '错误的提交']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  {{$ModelName}}  ${{$modelName}}
     * @return \Illuminate\Http\Response
     */
    public function destroy({{$ModelName}} ${{$modelName}})
    {
        //
    }
}
