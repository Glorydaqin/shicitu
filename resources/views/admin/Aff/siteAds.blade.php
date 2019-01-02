@extends("admin.layouts.list")

@section('title')
<h5>站群广告设置 <small>list</small></h5>
@endsection

@section("search")
<form action="" method="get">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-sm-4 m-b-xs">
            <select class="input-sm form-control input-s-sm inline" name="ad_type">
                <option>广告类型</option>
                <option value="box">小方块</option>
                <option value="banner">横幅</option>
                <option value="floor">摩天楼</option>
            </select>
        </div>
        <div class="col-sm-4 m-b-xs">
            <select class="input-sm form-control input-s-sm inline" name="site_type">
                <option>网站类型</option>
                <option value="Coupon">Coupon</option>
                <option value="Movie">Movie</option>
            </select>
        </div>
        <div class="col-sm-4">
            <div class="input-group">
                <input type="text" placeholder="广告字符串" class="input-sm form-control" name="ad_str" value=""> <span class="input-group-btn">
                                        <input type="submit" class="btn btn-sm btn-primary" name="add" value="添加"> </span>
            </div>
        </div>
    </div>
</form>
@endsection

@section("list")
<table class="table table-striped table-hover">
    <thead>
    <tr>

        <th>Image</th>
        <th>Str</th>
        <th>网站类型</th>
        <th>广告类型</th>
        <th>操作</th>
        
    </tr>
    </thead>
    <tbody>
    @foreach($site_ads as $item)
    <tr>
        <td><img width="100px" src="{{ $item->image }}" alt=""></td>
        <td>{{ $item->ad_str }}</td>
        <td>{{ $item->site_type }}</td>
        <td>{{ $item->ad_type }}</td>
        <td>
            <a href="{{ action("Admin\AffController@siteAdsDel",['id'=>$item->id]) }}" title="删除"><i class="fa fa-trash-o text-danger"></i></a>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@endsection

@section("page")
{{ $site_ads->links() }}
@endsection

@section("script")

@endsection