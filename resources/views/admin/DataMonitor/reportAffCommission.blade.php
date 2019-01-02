@extends("admin.layouts.list")

@section('title')
<h5>联盟收益 <small>list</small></h5>
@endsection

@section("search")
<form action="" method="get">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-sm-2 m-b-xs">
        </div>
        <div class="col-sm-2 m-b-xs">
        </div>
        <div class="col-sm-2 m-b-xs">
        </div>
        <div class="col-sm-2 m-b-xs">
        </div>
        <div class="col-sm-3">
            <div class="input-group">
                <input type="text" placeholder="Domain" class="input-sm form-control" name="TrackerName" value="{{ $_GET['TrackerName'] or '' }}">
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
        <th>联盟</th>
        <th>TrackerOrderID</th>
        <th>TrackerName</th>
        <th>点击时间</th>
        <th>收益</th>
        <th>货币</th>

    </tr>
    </thead>
    <tbody>
    @foreach($revenue as $item)
    <tr>
        <td>{{ $item->affManage->name }}</td>
        <td>{{ $item->TrackerOrderId }}</td>
        <td>{{ $item->TrackerName }}</td>
        <td>{{ $item->VisitTime }}</td>
        <td>{{ $item->Money }}</td>
        <td>{{ $item->Currency }}</td>

    </tr>
    @endforeach
    </tbody>
</table>
@endsection

@section("page")
{{ $revenue->appends(
    array(
    'VisitTime'=>isset($_REQUEST['VisitTime'])?$_REQUEST['VisitTime']:'',
    )
)->links() }}
@endsection

@section("script")

@endsection