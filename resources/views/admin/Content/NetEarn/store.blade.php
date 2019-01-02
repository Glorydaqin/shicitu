@extends("admin.layouts.list")

@section('title')
<h5>网赚 <small>list</small></h5>
@endsection

@section("search")
<form action="" method="get">
    {{ csrf_field() }}
    <div class="row">

    <div class="col-sm-2 m-b-xs">
        <select class="input-sm form-control input-s-sm inline" name="isOnline">
            <option value="">是否发布(默认未发布)</option>
            <option value="online" @if(isset($_GET['isOnline']) && $_GET['isOnline']=='online') selected @endif>已发布</option>
            <option value="unline" @if(isset($_GET['isOnline']) && $_GET['isOnline']=='unline') selected @endif>未发布</option>
        </select>
    </div>
    {{--<div class="col-sm-2 m-b-xs">--}}
        {{--<select class="input-sm form-control input-s-sm inline" name="tags">--}}
            {{--<option value="">标签</option>--}}
            {{--@foreach($type as $item)--}}
            {{--<option value="{{ $item->type }}" @if(isset($_GET['type']) && $_GET['type']== $item->type ) selected @endif>{{ $item->type }}</option>--}}
            {{--@endforeach--}}
        {{--</select>--}}
    {{--</div>--}}
    <div class="col-sm-3">
        <div class="input-group">
            <input type="text" placeholder="title" class="input-sm form-control" name="title" value="{{ $_GET['title'] or '' }}">
            <span class="input-group-btn">
                <input type="submit" class="btn btn-sm btn-primary" name="search" value="搜索">
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
        <th>源地址</th>
        <th>标题</th>
        <th>type</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td><a target="_blank" href="{{ $item->url }}">{{ $item->url }}</a></td>
        <td>{{ $item->title }}</td>
        <td>{{ $item->type }}</td>
        <td>

            @if(isset($item->content_id) && !empty($item->content_id))
                已发布
            @else
                <a href='{{ action('Admin\Content\NetEarnController@push',array("id"=>$item->id)) }}'>发布</a>
            @endif
        </td>
    </tr>
    @endforeach
    </tbody> 
</table>
@endsection

@section("page")
{{ $list->appends(
    array(
    'is_online'=>isset($_REQUEST['is_online'])?$_REQUEST['is_online']:'',
    'title'=>isset($_REQUEST['title'])?$_REQUEST['title']:'',
    )
)->links() }}
@endsection
