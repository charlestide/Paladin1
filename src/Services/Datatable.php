<?php
/**
 * Created by PhpStorm.
 * User: tangkeyu<charlestide@vip.163.com>
 * Date: 2018/1/16
 * Time: 上午12:50
 */

namespace Charlestide\Paladin\Services;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Datatable
{
    /**
     * @param Builder|Model $query
     * @return mixed
     */
    static public function of($query,int $page = 1) {

        if ($query instanceof Model) {
            $query = $query->newQuery();
        }

        return self::parse($query->newQuery());

    }

    /**
     * @param Builder|Model $query
     * @return array
     */
    static private function parse( $query) {

        $request = request();

        if ($request->has('columns')) {

            $columnQuery = $request->acceptsJson() ? json_decode($request->query('columns')) : $request->query('columns');

            foreach ($columnQuery as $name => $column) {
                if ($name) {
                    if (isset($column->search)) {
                        $query->where($name,'like','%'.$column->search.'%');
                    }

                    if (isset($column->order)) {
                        $query->orderBy($name,$column->order);
                    }

                    if (isset($column->except)) {
                        if (is_array($column->except)) {
                            $query->whereNotIn($name, $column->except);
                        } else {
                            $query->where($name,'<>',$column->except);
                        }
                    }
                }
            }
        }

        $pager = $query->paginate($request->input('perPage',20));
        return [
            'total' => $pager->total(),
            'data' => $pager->items(),
            'perPage' => $pager->perPage(),
            'currentPage' => $pager->currentPage(),
            'status' => true,
            'message' => '获取数据成功'
        ];
    }
}