@extends("admin.layouts.list")

@section('title')
<h5>临时商家整理 <small>list</small></h5>
@endsection

@section("search")
<form action="" method="get">
    {{ csrf_field() }}
    <div class="row">
    <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control input-s-sm inline" name="CompetitorId">
            <option value="">请选择</option>
            @foreach($competitors as $competitor)
            <option value="{{ $competitor->CompetitorId }}" @if(isset($_GET['CompetitorId']) && $_GET['CompetitorId']==$competitor->CompetitorId) selected @endif >{{ $competitor->competitor->Url }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-2 m-b-xs">
        <select class="input-sm form-control input-s-sm inline" name="Domain">
            <option value="">Domain</option>
            <option value="Domain Error" @if(isset($_GET['Domain']) && $_GET['Domain']=='Domain Error') selected @endif>Domain Error</option>
        </select>
    </div>
    <div class="col-sm-2 m-b-xs">
        <select class="input-sm form-control input-s-sm inline" name="GoUrlOpt">
            <option value="">GoCouponUrl</option>
            <option value="yes" @if(isset($_GET['GoUrlOpt']) && $_GET['GoUrlOpt']=='yes') selected @endif>GoUrl 不为空</option>
            <option value="no" @if(isset($_GET['GoUrlOpt']) && $_GET['GoUrlOpt']=='no') selected @endif>GoUrl 为空</option>
        </select>
    </div>
    <div class="col-sm-3">
        <div class="input-group">
            <input type="text" placeholder="StoreUrl" class="input-sm form-control" name="StoreUrl" value="{{ $_GET['StoreUrl'] or '' }}"> <span class="input-group-btn">
                                    <input type="submit" class="btn btn-sm btn-primary" name="submit" value="搜索"> </span>
            <span class="input-group-btn">
                <a href="{{ action("Admin\CpContentController@resetTempErrorTime") }}" class="btn btn-sm btn-info">重置程序匹配</a>
                <input type="button" id="multi_push" class="btn btn-sm btn-success"  value="批量提交"/>
                <input type="button" id="multi_click" class="btn btn-sm btn-danger"  value="批量点击"/>
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
        <th>StoreUrl</th>
        <th>H1</th>
        <th>Domain</th>
        <th>PageDomainUrl</th>
        <th>GoUrl</th>
        <th>GoCouponUrl</th>
        <th>ErrorTime</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tempStore as $item)
    <tr>
        <td><input type="checkbox" name="id[]" value="{{ $item->ID }}"></td>
        <td><a href="{{ $item->StoreUrl }}" target="_blank">{{ $item->StoreUrl }}</a></td>
        <td>{{ $item->H1 }}</td>
        <td>{{ $item->Domain }}</td>
        <td>{{ $item->PageDomainUrl }}</td>
        <td><a href="{{ $item->GoUrl }}" target="_blank">{{ mb_substr($item->GoUrl,0,30) }}</a></td>
        <td class="goCpUrl" on_id="{{ $item->ID }}"><a href="{{ $item->GoCouponUrl }}" target="_blank">{{ mb_substr($item->GoCouponUrl,0,30) }}</a></td>
        <td>{{ $item->ErrorTime }}</td>
        <td>
            <a href="{{ action("Admin\CpContentController@addCs",['ID'=>$item->ID]) }}" title="添加到正式库"><i class="fa fa-check text-navy"></i></a>
            <a href="{{ action("Admin\CpContentController@delTemp",['ID'=>$item->ID]) }}" title="删除错误数据"><i class="fa fa-trash-o text-danger"></i></a>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@endsection

@section("page")
{{ $tempStore->appends(
    array(
    'CompetitorId'=>isset($_REQUEST['CompetitorId'])?$_REQUEST['CompetitorId']:'',
    'Domain'=>isset($_REQUEST['Domain'])?$_REQUEST['Domain']:'',
    'GoUrlOpt'=>isset($_REQUEST['GoUrlOpt'])?$_REQUEST['GoUrlOpt']:'',
    'StoreUrl'=>isset($_REQUEST['StoreUrl'])?$_REQUEST['StoreUrl']:'',
    )
)->links() }}
@endsection

@section("script")
<script>
    $(document).ready(function(){
        $(".goCpUrl").dblclick(function(){
            var insert_vl = "<div class='input-group'><input type='text' class='input-sm form-control' onblur='save_input(this)'/><span class='input-group-btn'><input type='button' onclick='save_on_date(this)' class='btn btn-sm btn-success' value='save'/></span></div>";
            $(this).html(insert_vl);
            $(this).find('input[type=text]').focus();
        });
    });
    function save_input(v) {
        var on_url = $(v).val();
        var on_id = $(v).parent().parent().attr("on_id");
        if(on_url!==''&& on_id!==''){
            $.post("{{ action('Admin\CpContentController@saveCouponUrl') }}", { on_url: on_url, on_id: on_id },function(data){
                if(data){
                    $(v).parent().parent().html(data);
                }
            });
        }
    }
    function save_on_date(v){
        var on_url = $(v).parent().prev().val();
        var on_id = $(v).parent().parent().parent().attr("on_id");
        $.post("{{ action('Admin\CpContentController@saveCouponUrl') }}", { on_url: on_url, on_id: on_id },function(data){
            if(data){
                $(v).parent().parent().parent().html(data);
            }
        });
    }

//    多选
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
            alert("请先选择");
        }else{
            direct('{{ action("Admin\CpContentController@addCsMulti") }}?id='+data);
        }
    });
    $("#multi_click").click(function () {
        var data = new Array();
        var goUrl = '';
        var storeUrl = '';
        $("input[name='id[]']").each(function () {
            if(this.checked == true){
                goUrl =$(this).parent().parent().children().eq(5).find('a').attr('href');
                storeUrl =$(this).parent().parent().children().eq(1).find('a').attr('href');
                if(goUrl !==''){
                    data.push(goUrl);
                }else{
                    data.push(storeUrl);
                }
            }

        });
        if(data.length==0){
            alert("请先选择");
        }else{
            for(var i=0;i<data.length;i++){
                newtab_open(data[i]);
            }
        }
    });
    function newtab_open($url){
        window.open($url,'_blank');
    }
    function direct($url) {
        window.location.href=$url;
    }
</script>
@endsection