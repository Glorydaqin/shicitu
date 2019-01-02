@extends("admin.layouts.list")

@section('title')
<h5>分类管理 <small>list</small></h5>
@endsection

@section("search")
<form action="" method="get">
    {{ csrf_field() }}
    <div class="row">
    <div class="col-sm-2 m-b-xs">
        <select class="input-sm form-control input-s-sm inline" name="IsCate">
            <option value="">是否处理(默认未处理)</option>
            <option value="1" @if(isset($_GET['IsCate']) && $_GET['IsCate']=='1') selected @endif>已处理</option>
            <option value="0" @if(isset($_GET['IsCate']) && $_GET['IsCate']=='0') selected @endif>未处理</option>
        </select>
    </div>
    <div class="col-sm-3">
        <div class="input-group">
            <input type="text" placeholder="Name" class="input-sm form-control" name="Name" value="{{ $_GET['Name'] or '' }}">
            <span class="input-group-btn">
                <input type="submit" class="btn btn-sm btn-primary" name="submit" value="搜索">
            </span>
        </div>
    </div>
    </div>
</form>
@endsection

@section("list")
<table class="table table-striped table-hover">
    <thead>
    <tr>

        <th>ID</th>
        <th>Name</th>
        <th>IsCate</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $item)
    <tr ondblclick="toggleTrCheck(this)" style="cursor:pointer">
        <td>{{ $item->ID }}</td>
        <td>{{ $item->Name }}</td>
        <td>{{ $item->IsCate }}</td>
        <td>
            @if($item->IsCate)
                已处理
            @else
                <a href="javascript:;" onclick="toggleCheck(this)">处理分类</a>
            @endif
        </td>
    </tr>
    <tr style="display: none">
        <td colspan="4">
            <form action="{{ action("Admin\CpContentController@cateDeal") }}">
                <input type="hidden" name="ID" value="{{ $item->ID }}">
                <div class="form-group">
                    <label class="col-sm-1 control-label">{{ $item->Name }}</label>

                    <div class="col-sm-10">
                        @foreach($webCates as $cate)
                        <label class="checkbox-inline i-checks">
                            <input name="cate_id[]" type="checkbox" value="{{ $cate->id }}">{{ $cate->name }}
                        </label>
                        @endforeach
                    </div>
                    <div class="col-sm-1">
                        <input type="submit" class="btn btn-sm btn-primary" name="submit" value="提交">
                    </div>
                </div>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@endsection

@section("page")
{{ $list->appends(
    array(
    'IsCate'=>isset($_REQUEST['IsCate'])?$_REQUEST['IsCate']:'',
    'Name'=>isset($_REQUEST['Name'])?$_REQUEST['Name']:'',
    )
)->links() }}
@endsection

@section("script")
<script>
    function toggleCheck(v){
        $(v).parent().parent().next().toggle();
    }
    function toggleTrCheck(v){
        $(v).next().toggle();
    }
</script>
@endsection