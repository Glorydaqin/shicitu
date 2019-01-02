@extends("admin.layouts.list")

@section('title')
<h5>Coupon网站管理 <small>list</small></h5>
@endsection

@section("search")
<form action="" method="get">
    {{ csrf_field() }}
    <div class="row">
    <div class="col-sm-2 m-b-xs">
        <select class="input-sm form-control input-s-sm inline" name="site">
            <option value="">网站</option>
            <option value="PromosGo" @if(isset($_GET['site']) && $_GET['site']=='PromosGo') selected @endif >PromosGo</option>
            <option value="CouponsPluses" @if(isset($_GET['site']) && $_GET['site']=='CouponsPluses') selected @endif >CouponsPluses</option>
            <option value="ETDiscounts" @if(isset($_GET['site']) && $_GET['site']=='ETDiscounts') selected @endif >ETDiscounts</option>
            <option value="ETPromos" @if(isset($_GET['site']) && $_GET['site']=='ETPromos') selected @endif >ETPromos</option>
            <option value="ETVouchersPro" @if(isset($_GET['site']) && $_GET['site']=='ETVouchersPro') selected @endif >ETVouchersPro</option>
            <option value="ETGutschein" @if(isset($_GET['site']) && $_GET['site']=='ETGutschein') selected @endif >ETGutschein</option>
        </select>
    </div>
    <div class="col-sm-2 m-b-xs">
        <select class="input-sm form-control input-s-sm inline" name="hasPic">
            <option value="">图片</option>
            <option value="1" @if(isset($_GET['hasPic']) && $_GET['hasPic']=='1') selected @endif>无图</option>
            <option value="0" @if(isset($_GET['hasPic']) && $_GET['hasPic']=='0') selected @endif>有图</option>
        </select>
    </div>
    <div class="col-sm-2 m-b-xs">
        <select class="input-sm form-control input-s-sm inline" name="hasCate">
            <option value="">分类</option>
            <option value="1" @if(isset($_GET['hasCate']) && $_GET['hasCate']=='1') selected @endif>有分类</option>
            <option value="0" @if(isset($_GET['hasCate']) && $_GET['hasCate']=='0') selected @endif>无分类</option>
        </select>
    </div>
    <div class="col-sm-3">
        <div class="input-group">
            <input type="text" placeholder="Domain" class="input-sm form-control" name="storeDomain" value="{{ $_GET['storeDomain'] or '' }}">
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
        <th>name</th>
        <th>store_domain</th>
        <th>is_category</th>
        <th>人工描述</th>
        <th>status</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->store_domain }}</td>
        <td>{{ $item->is_category }}</td>
        <td>@if(!empty($item->store_full_desc)) yes @else no @endif</td>
        <td>{{ $item->status }}</td>

        <td><a href="{{ action("Admin\Web\CouponController@descEdit",['id'=>$item->id]) }}" title="改商家富文本描述"><i class="fa fa-repeat text-navy"></i></a>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@endsection

@section("page")
{{ $list->appends(
    array(
    'site'=>isset($_REQUEST['site'])?$_REQUEST['site']:'',
    'hasPic'=>isset($_REQUEST['hasPic'])?$_REQUEST['hasPic']:'',
    'hasCate'=>isset($_REQUEST['hasCate'])?$_REQUEST['hasCate']:'',
    'storeDomain'=>isset($_REQUEST['storeDomain'])?$_REQUEST['storeDomain']:''
    )
)->links() }}
@endsection

@section("script")
<script>
    $(document).ready(function(){
        $(".goCpUrl").dblclick(function(){
            var insert_vl = "<div class='input-group'><input type='text' class='input-sm form-control'/><span class='input-group-btn'><input type='button' onclick='save_on_date(this)' class='btn btn-sm btn-success' value='save'/></span></div>";
            $(this).html(insert_vl);
        });
    });
    function save_on_date(v){
        var on_url = $(v).parent().prev().val();
        var on_id = $(v).parent().parent().parent().attr("on_id");
        $.post("{{ action('Admin\CpContentController@saveCouponUrl') }}", { on_url: on_url, on_id: on_id },function(data){
            if(data == "ok"){
                $(v).parent().parent().parent().html(on_url);
            }
        });
    }
</script>
@endsection