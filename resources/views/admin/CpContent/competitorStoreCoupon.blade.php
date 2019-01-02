@extends("admin.layouts.list")

@section('title')
<h5>商家管理 <small>查看竞争对手Coupon</small></h5>
@endsection

@section("search")
@endsection

@section("list")
<table class="table table-striped table-hover">
    <thead>
    <tr>

        <th>ID</th>
        <th>CouponTitle</th>
        <th>CouponCode</th>
        <th>ExpirationDate</th>
        <th>Type</th>
        <th>LastChangeTime</th>
    </tr>
    </thead>
    <tbody>
    @foreach($competitorStoreCoupon as $item)
    <tr>
        <td>{{ $item->ID }}</td>
        <td>{{ $item->CouponTitle }}</td>
        <td>{{ $item->CouponCode }}</td>
        <td>{{ $item->ExpirationDate }}</td>
        <td>{{ $item->Type }}</td>
        <td>{{ $item->LastChangeTime }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
@endsection

@section("page")
{{ $competitorStoreCoupon->appends(
    array(
    'type'=>isset($_REQUEST['type'])?$_REQUEST['type']:'',
    'id'=>isset($_REQUEST['id'])?$_REQUEST['id']:'',
    )
)->links() }}
@endsection

@section("script")
@endsection