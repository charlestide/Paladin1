namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Charlestide\Paladin\Controllers\Controller;
use {{get_class($model)}};

class {{$ModelName}}Controller extends Controller
{

    /**
    * @var string 需要验证权限的Model
    */
    protected $authModel = {{$ModelName}}::class;



    /**
    * Contructor
    *
    * @return App\Http\Controllers\{{$ModelName}}
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

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

            return redirect('/{{$modelName}}/'.${{$modelName}}->id)->with('tip','{{$modelDisplayName}} 保存成功');
        } else {
            return redirect()->back()->with('tip','{{$modelDisplayName}} 保存失败');
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

            return redirect('/{{$modelName}}/'.${{$modelName}}->id)->with('tip','{{$modelDisplayName}} 保存成功');
        } else {
            return redirect()->back()->with('tip','{{$modelDisplayName}} 保存失败');
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
        try {
            ${{$modelName}}->delete();
            return redirect()->with('tip','{{$modelDisplayName}} 删除成功');
        } catch (\Exception $e) {
            return redirect()->back()->with('tip','{{$modelDisplayName}} 删除失败');
        }
    }
}
