@extends("admin.layouts.list")

@section('title')
<h5>商家管理 <small>查看竞争对手</small></h5>
@endsection

@section("search")
@endsection

@section("list")
<table class="table table-striped table-hover">
    <thead>
    <tr>

        <th>ID</th>
        <th>Url</th>
        <th>H1</th>
        <th>Logo</th>
        <th>LastChangeTime</th>
    </tr>
    </thead>
    <tbody>
    @foreach($competitorStore as $item)
    <tr>
        <td>{{ $item->ID }}</td>
        <td><a href="{{ $item->Url }}" target="_blank">{{ $item->Url }}</a></td>
        <td>{{ $item->H1 }}</td>
        <td>@if($item->ScreenImg) <img src="{{ $item->ScreenImg }}" alt=""> @endif</td>
        <td>{{ $item->LastChangeTime }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
@endsection

@section("page")

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