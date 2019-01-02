<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>H+ 后台主题UI框架 - 首页示例二</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico"> <link href="css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="css/font-awesome.min.css?v=4.4.0" rel="stylesheet">

    <!-- Morris -->
    <link href="css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/style.min.css?v=4.0.0" rel="stylesheet">

</head>

<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="row">
        {{--<div class="col-sm-3">--}}
            {{--<div class="ibox float-e-margins">--}}
                {{--<div class="ibox-title">--}}
                    {{--<span class="label label-success pull-right">昨日Coupon站点</span>--}}
                    {{--<h5>访客</h5>--}}
                {{--</div>--}}
                {{--<div class="ibox-content">--}}
                    {{--<h1 class="no-margins">{{ $reportViewClick->activeNum }}</h1>--}}
                    {{--<div class="stat-percent font-bold text-success">{{ getPercent($reportViewClick->ipTrackNum,$reportViewClick->activeNum) }} <i class="fa fa-bolt"></i>--}}
                    {{--</div>--}}
                    {{--<small>点击率</small>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-sm-3">--}}
            {{--<div class="ibox float-e-margins">--}}
                {{--<div class="ibox-title">--}}
                    {{--<span class="label label-info pull-right">昨日Coupon站点</span>--}}
                    {{--<h5>出站</h5>--}}
                {{--</div>--}}
                {{--<div class="ibox-content">--}}
                    {{--<h1 class="no-margins">{{ $reportViewClick->ipTrackNum }}</h1>--}}
                    {{--<div class="stat-percent font-bold text-info">{{ getPercent($reportViewClick->ipAffTrackNum,$reportViewClick->ipTrackNum) }} <i class="fa fa-level-up"></i>--}}
                    {{--</div>--}}
                    {{--<small>联盟命中率</small>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="col-sm-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-warning pull-right">昨日：{{ $revenue['yesterdayRevenue'] }}</span>
                    <h5>Coupon收益($|€)</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">本周：{{ $revenue['weekRevenue'] }}</h1>
                    <div class="stat-percent font-bold text-info">{{ $revenue['monthRevenue'] }} <i class="fa fa-level-up"></i>
                    </div>
                    <small>本月</small>
                </div>
            </div>
        </div>
    </div>


    <div class="row">

        <div class="col-sm-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>临时表汇总</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table table-hover no-margins">
                        <thead>
                        <tr>
                            <th>竞争对手</th>
                            <th>商家总数</th>
                            <th>待处理总数</th>
                            <th>比例</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tempDeal as $deal)
                        <tr>
                            <td>
                                <span style="color:hotpink;">[{{ $deal->Country }}][{{ $deal->ShowText }}]</span>{{ getDomain($deal->Url) }}
                            </td>
                            <td>{{ $deal->num }}</td>
                            <td>
                                @if(isset($deal->dealNum))
                                    <a href="{{ action('Admin\CpContentController@tempStore',['CompetitorId'=>$deal->ID]) }}" title="继续处理">{{ $deal->dealNum }}</a>
                                @else
                                    <span class="label label-primary">已完成</span>
                                @endif
                            </td>
                            <td class="text-navy">
                                <i class="fa fa-level-up"></i>
                                @if(isset($deal->dealNum))
                                    {{ substr($deal->dealNum/$deal->num*100,0,5) }}%
                                @else
                                    0%
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>站点更新率</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table table-hover no-margins">
                        <thead>
                        <tr>
                            <th>站点名称</th>
                            <th>商家数</th>
                            <th>优惠券=0</th>
                            <th>优惠券<3</th>
                            <th>无图片</th>
                            <th>无类别</th>
                            <th>周更新率</th>
                            <th>检查时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reportMerCoupon as $report)
                            <tr>
                                <td>{{ $report->SiteName }}</td>
                                <td>{{ $report->MerNum }}</td>
                                <td>{{ $report->MerCouponZero }}({{ getPercent($report->MerCouponZero,$report->MerNum) }})</td>
                                <td>{{ $report->CouponLgMin }}({{ getPercent($report->CouponLgMin,$report->MerNum) }})</td>
                                <td>{{ $report->MerNoImg }}</td>
                                <td>{{ $report->MerNoCate }}</td>
                                <td>{{ $report->MerUpWeek }}({{ getPercent($report->MerUpWeek,$report->MerNum) }})</td>
                                <td>{{ date('m/d',strtotime($report->AddDate )) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{ $reportMerCoupon->links() }}
                    </div>
                    <div class="text-center">
                        <a href="{{ action('Admin\DataMonitorController@reportMerCoupon') }}">查看详细数据</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>抓取统计</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table table-hover no-margins">
                        <thead>
                        <tr>
                            <th>时间</th>
                            <th>竞争对手</th>
                            <th>抓取html</th>
                            <th>sale</th>
                            <th>code</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reportCatchNum as $key=>$report)
                            @foreach($report as $competitorId=>$item)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{ $competitorId }}(<a href="{{ $item['competitorUrl'] }}" target="_blank">{{ $item['competitorUrl'] }}</a>)</td>
                                    <td>{{ $item['catchHtmlNum'] }}</td>
                                    <td>{{ $item['saleNum'] }}</td>
                                    <td>{{ $item['codeNum'] }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="js/jquery.min.js?v=2.1.4"></script>
<script src="js/bootstrap.min.js?v=3.3.5"></script>
<script src="js/plugins/flot/jquery.flot.js"></script>
<script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="js/content.min.js?v=1.0.0"></script>
<script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

</body>

</html>