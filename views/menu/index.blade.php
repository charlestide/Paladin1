@extends('paladin::layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')
    <pvc-bread-crumb icon="user" title="菜单" summary="菜单列表">
        <pvc-bread-crumb-item title="菜单" url="/menu"></pvc-bread-crumb-item>
    </pvc-bread-crumb>

    <pvc-panel>
        <pvc-link-button slot="head-right" href="{{url('/menu/create')}}" title="新增" icon="plus-square" class="btn-theme" size="sm"></pvc-link-button>
        <pvc-fancytree id="tree" :table="[{key:'title',title:'标题'},{key:'url',title:'URL'},{key:'action',title:'操作'}]" :checkbox="true">
            @foreach(\Charlestide\Paladin\Models\Menu::where('parent_id',0)->get() as $menu)
                <pvc-tree-node icon="{{$menu->icon}}" :expanded="true" title="{{$menu->name}}" url="{{$menu->url}}">
                    <pvc-button action="{{url("/menu/create/$menu->id")}}" title="添加子菜单" icon="plus" slot="action" column="2"></pvc-button>
                    <pvc-button action="{{url("/menu/$menu->id/edit")}}" title="修改" slot="action" icon="edit" column="2"></pvc-button>
                    <pvc-button action="{{url("/menu/$menu->id/delete")}}" title="删除" slot="action" icon="remove" column="2"></pvc-button>
                @if($menu->children->count())
                    @foreach($menu->children as $submenu)
                        <pvc-tree-node icon="{{$submenu->icon}}" title="{{$submenu->name}}" :expanded="true" url="{{$submenu->url}}">
                            <pvc-button action="{{url("/menu/create/$submenu->id")}}" title="添加子菜单" icon="plus" slot="action" column="2"></pvc-button>
                            <pvc-button action="{{url("/menu/$submenu->id/edit")}}" title="修改" slot="action" icon="edit" column="2"></pvc-button>
                            <pvc-button action="{{url("/menu/$submenu->id")}}" title="删除" method="delete" slot="action" icon="remove" column="2"></pvc-button>
                        @if($submenu->children->count())
                                @foreach($submenu->children as $littleMenu)
                                <pvc-tree-node icon="{{$littleMenu->icon}}" title="{{$littleMenu->name}}" :expanded="true" url="{{$littleMenu->url}}">
                                    <pvc-button action="{{url("/menu/create/$littleMenu->id")}}" title="添加子菜单" icon="plus" slot="action" column="2"></pvc-button>
                                    <pvc-button action="{{url("/menu/$littleMenu->id/edit")}}" title="修改" slot="action" icon="edit" column="2"></pvc-button>
                                    <pvc-button action="{{url("/menu/$littleMenu->id")}}" title="删除" confirm="确定要删掉这个菜单吗？" slot="action" icon="remove" column="2"></pvc-button>
                                </pvc-tree-node>
                                @endforeach
                            @endif
                        </pvc-tree-node>
                    @endforeach
                </pvc-tree-node>
                @endif
            @endforeach
        </pvc-fancytree>
    </pvc-panel>

@push('scripts')
    <script type="text/javascript" src="/paladin/js/data.js"></script>
@endpush
@stop
<!--/ END PAGE CONTENT -->

