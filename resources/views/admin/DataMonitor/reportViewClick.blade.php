@extends("admin.layouts.echarts")

@section('title')
点击命中率
@endsection

@section("search")
<form action="" method="get">
    <div class="row">
        <div class="col-sm-5 m-b-xs">
            <select class="input-sm form-control input-s-sm inline" name="siteName">
                @foreach($siteName as $site)
                    <option value="{{ $site->siteName }}" @if(isset($_GET['siteName']) && $_GET['siteName']==$site->siteName) selected @endif>{{$site->siteName}}</option>
                @endforeach
            </select>
            <select name="type" class="input-sm form-control input-s-sm inline">
                <option value="week" @if(isset($_GET['type']) && $_GET['type']=='week') selected @endif >一周</option>
                <option value="month" @if(isset($_GET['type']) && $_GET['type']=='month') selected @endif>一月</option>
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
            text: '点击命中状况堆叠图'
        },
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data:['展示数UV','出站数','ip唯一出站数','联盟命中数','ip唯一联盟命中数']
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
                name:'展示数UV',
                type:'line',
                stack: '总量',
                areaStyle: {normal: {}},
                data:[{{ $activeNum }}]
            },
            {
                name:'出站数',
                type:'line',
                stack: '总量',
                areaStyle: {normal: {}},
                data:[{{ $allTrackNum }}]
            },
            {
                name:'ip唯一出站数',
                type:'line',
                stack: '总量',
                areaStyle: {normal: {}},
                data:[{{ $ipTrackNum }}]
            },
            {
                name:'联盟命中数',
                type:'line',
                stack: '总量',
                areaStyle: {normal: {}},
                data:[{{ $allAffTrackNum }}]
            },
            {
                name:'ip唯一联盟命中数',
                type:'line',
                stack: '总量',
                areaStyle: {normal: {}},
                data:[{{ $ipAffTrackNum }}]
            },
        ]
    };


    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>
@endsection