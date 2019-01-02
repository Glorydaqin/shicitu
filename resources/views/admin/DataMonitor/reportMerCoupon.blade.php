@extends("admin.layouts.echarts")

@section('title')
站点更新率
@endsection

@section("search")
<form action="" method="get">
    <div class="row">
        <div class="col-sm-5 m-b-xs">
            <select class="input-sm form-control input-s-sm inline" name="siteName">
                @foreach($siteName as $site)
                    <option value="{{ $site->SiteName }}" @if(isset($_GET['siteName']) && $_GET['siteName']==$site->SiteName) selected @endif>{{$site->SiteName}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-4 m-b-xs">

        </div>
        <div class="col-sm-3">
            <input type="submit" name="submit" class="btn btn-sm btn-primary" value="筛选">
        </div>
    </div>
</form>
@endsection

@section("script")
<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('echarts'));

    // 指定图表的配置项和数据
    var option = {
        title: {
            text: '网站状况堆叠图'
        },
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data:['商家数','coupon=0','coupon<3','无Logo','未分类','日更新率','周更新率','月更新率']
        },
        toolbox: {
            feature: {
                saveAsImage: {}
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis : [
            {
                type : 'category',
                boundaryGap : false,
                data : ['{!! $date !!}']
            }
        ],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : [
            {
                name:'商家数',
                type:'line',
                stack: '总量',
                areaStyle: {normal: {}},
                data:[{{ $num }}]
            },
            {
                name:'coupon=0',
                type:'line',
                stack: '总量',
                areaStyle: {normal: {}},
                data:[{{ $couponZero }}]
            },
            {
                name:'coupon<3',
                type:'line',
                stack: '总量',
                areaStyle: {normal: {}},
                data:[{{ $couponMin }}]
            },
            {
                name:'无Logo',
                type:'line',
                stack: '总量',
                areaStyle: {normal: {}},
                data:[{{ $noImg }}]
            },
            {
                name:'未分类',
                type:'line',
                stack: '总量',
                areaStyle: {normal: {}},
                data:[{{ $noCate }}]
            },
            {
                name:'日更新率',
                type:'line',
                stack: '总量',
                areaStyle: {normal: {}},
                data:[{{ $upDay }}]
            },
            {
                name:'周更新率',
                type:'line',
                stack: '总量',
                areaStyle: {normal: {}},
                data:[{{ $upWeek }}]
            },
            {
                name:'月更新率',
                type:'line',
                stack: '总量',
                areaStyle: {normal: {}},
                data:[{{ $upMonth }}]
            },
        ]
    };


    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>
@endsection