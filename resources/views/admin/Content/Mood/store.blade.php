@extends("admin.layouts.list")

@section('title')
<h5>语录 <small>list</small></h5>
@endsection

@section("search")
<form action="" method="get">
    {{ csrf_field() }}
    <div class="row">

    <div class="col-sm-2 m-b-xs">
        <select class="input-sm form-control input-s-sm inline" name="is_online">
            <option value="">是否发布(默认未发布)</option>
            <option value="online" @if(isset($_GET['is_online']) && $_GET['is_online']=='online') selected @endif>已发布</option>
            <option value="unline" @if(isset($_GET['is_online']) && $_GET['is_online']=='unline') selected @endif>未发布</option>
        </select>
    </div>
    <div class="col-sm-2 m-b-xs">
        <select class="input-sm form-control input-s-sm inline" name="tags">
            <option value="">标签</option>
            @foreach($type as $item)
            <option value="{{ $item->type }}" @if(isset($_GET['type']) && $_GET['type']== $item->type ) selected @endif>{{ $item->type }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-3">
        <div class="input-group">
            <input type="text" placeholder="title" class="input-sm form-control" name="title" value="{{ $_GET['title'] or '' }}">
            <span class="input-group-btn">
                <input type="submit" class="btn btn-sm btn-primary" name="search" value="搜索">
            </span>
            <span class="input-group-btn">
                <input type="button" class="btn btn-sm btn-primary" id="multi_push" value="批量发布">
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
        <th>全选<input type="checkbox" id="checkall"></th>
        <th>ID</th>
        <th>源地址</th>
        <th>img</th>
        <th>内容</th>
        <th>type</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $item)
    <tr>
        <td><input type="checkbox" name="id[]" value="{{ $item->id }}"></td>
        <td>{{ $item->id }}</td>
        <td><a href="{{ $item->url }}">{{ $item->url }}</a></td>
        <td>
            <img width="200px" src="{{ $item->image_url }}" alt="">
        </td>
        <td>{{ $item->desc }}</td>
        <td>{{ $item->type }}</td>
        <td>

            @if($item->is_online =='unline')
                <form action="{{ action("Admin\Content\MoodController@push") }}">
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <select name="category_id" id="">
                        @foreach($category as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                    <input type="submit" name="submit" value="发布">
                </form>
            @else
                已发布
            @endif
                <br>
                <a href="{{ action("Admin\Content\MoodController@delete",array('id'=>$item->id)) }}">删除</a>
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
    'type'=>isset($_REQUEST['type'])?$_REQUEST['type']:'',
    )
)->links() }}
@endsection

@section("script")
    <script>
        $("#checkall").click(function(){
            if(this.checked){
                $("input[name='id[]']").each(function(){
                    this.checked = true;
                });
            }else{
                $("input[name='id[]']").each(function(){
                    this.checked = false;
                });
            }
        });
        $("#multi_push").click(function () {
            var data = '';
            $("input[name='id[]']").each(function () {
                if(this.checked == true){
                    data+=','+this.value;
                }
            });
            data = data.substr(1,data.length);
            if(data.length==0){
                alert("请选择");
            }else{
                direct('{{ action("Admin\Content\MoodController@multi_push") }}?id='+data);
            }
        });
        function direct($url) {
            window.location.href=$url;
        }
    </script>
@endsection