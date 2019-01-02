@extends("admin.layouts.list")

@section('title')
<h5>商家管理 <small>list</small></h5>
@endsection

@section("search")
<form action="" method="get">
    {{ csrf_field() }}
    <div class="row">
    <div class="col-sm-2 m-b-xs">
        <select class="input-sm form-control input-s-sm inline" name="Country">
            <option value="">国家</option>
            @foreach($countries as $country)
            <option value="{{ $country->Country }}" @if(isset($_GET['Country']) && $_GET['Country']==$country->Country) selected @endif >{{ $country->Country }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-2 m-b-xs">
        <select class="input-sm form-control input-s-sm inline" name="IsAff">
            <option value="">联盟</option>
            <option value="1" @if(isset($_GET['IsAff']) && $_GET['IsAff']=='1') selected @endif>有联盟</option>
            <option value="0" @if(isset($_GET['IsAff']) && $_GET['IsAff']=='0') selected @endif>无联盟</option>
        </select>
    </div>
    <div class="col-sm-2 m-b-xs">
        <select class="input-sm form-control input-s-sm inline" name="site">
            <option value="">站点</option>
            <option value="sync_store_promosgo_mapping" @if(isset($_GET['site']) && $_GET['site']=='sync_store_promosgo_mapping') selected @endif>promosgo</option>
            <option value="sync_store_promosgo_fr_mapping" @if(isset($_GET['site']) && $_GET['site']=='sync_store_promosgo_fr_mapping') selected @endif>promosgo_fr</option>
            <option value="sync_store_9qmmm_mapping" @if(isset($_GET['site']) && $_GET['site']=='sync_store_9qmmm_mapping') selected @endif>9qmmm</option>
        </select>
    </div>
    <div class="col-sm-2 m-b-xs">
        <select class="input-sm form-control input-s-sm inline" name="isOnline">
            <option value="">是否上线</option>
            <option value="online" @if(isset($_GET['isOnline']) && $_GET['isOnline']=='online') selected @endif>已上线</option>
            <option value="unline" @if(isset($_GET['isOnline']) && $_GET['isOnline']=='unline') selected @endif>未上线</option>
        </select>
    </div>
    <div class="col-sm-3">
        <div class="input-group">
            <input type="text" placeholder="Domain" class="input-sm form-control" name="Domain" value="{{ $_GET['Domain'] or '' }}">
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
        <th>Domain</th>
        <th>Country</th>
        <th>IsAff</th>
        <th>竞争对手</th>
        <th>所有促销</th>
        <th>有效促销</th>
        <th>有效Code</th>
        <th>LastChangeTime</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($store as $item)
    <tr>
        <td>{{ $item->ID }}</td>
        <td>{{ $item->Domain }}</td>
        <td>{{ $item->Country }}</td>
        <td>@if($item->IsAff==1)
                {{ getStoreAff($item->Domain) }}
            @else
                no
            @endif</td>
        <td><a href="{{ action("Admin\CpContentController@showCompetitorStore",['id'=>$item->ID]) }}" title="查看竞争对手信息">{{ $item->CsNum }}</a></td>
        <td><a href="{{ action("Admin\CpContentController@showCompetitorStoreCoupon",['id'=>$item->ID,'type'=>'all']) }}" title="查看竞争对手所有Coupon信息">{{ $item->AllCouponNum }}</a></td>
        <td><a href="{{ action("Admin\CpContentController@showCompetitorStoreCoupon",['id'=>$item->ID,'type'=>'active']) }}" title="查看竞争对手有效Coupon信息">{{ $item->AllActiveNum }}</a></td>
        <td><a href="{{ action("Admin\CpContentController@showCompetitorStoreCoupon",['id'=>$item->ID,'type'=>'code']) }}" title="查看竞争对手有效Code信息">{{ $item->AllActiveCodeNum }}</a></td>
        <td>{{ $item->LastChangeTime }}<a href="{{ action("Admin\CpContentController@aheadLastChangeTime",['ID'=>$item->ID]) }}" title="提前更新数据"><i class="fa fa-repeat text-navy"></i></a></td>
        <td>
            {!! getStoreMappingInfo($item->ID) !!}
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@endsection

@section("page")
{{ $store->appends(
    array(
    'Country'=>isset($_REQUEST['Country'])?$_REQUEST['Country']:'',
    'IsAff'=>isset($_REQUEST['IsAff'])?$_REQUEST['IsAff']:'',
    'site'=>isset($_REQUEST['site'])?$_REQUEST['site']:'',
    'isOnline'=>isset($_REQUEST['isOnline'])?$_REQUEST['isOnline']:'',
    'Domain'=>isset($_REQUEST['Domain'])?$_REQUEST['Domain']:'',
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