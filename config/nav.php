<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/4
 * Time: 10:39
 */

return [

    '爬虫资源管理'=>
    [
        'icon'=>'fa-edit',
        'link'=>'#',

        'level'=>
        [
            '语录资源'=>'Admin\Content\MoodController@store',
            '网赚资源'=>'Admin\Content\NetEarnController@store',
        ]
    ],
    'coupon资源'=>[
        'icon'=>'fa-bar-chart-o',
        'link'=>'#',

        'level'=>[
            '临时商家整理'=>'Admin\CpContentController@tempStore',
            '商家管理'=>'Admin\CpContentController@store',
            '分类匹配'=>'Admin\CpContentController@cateStore'
        ]
    ],
    '数据监控'=>[
        'icon'=>'fa-bar-chart-o',
        'link'=>'#',

        'level'=>
        [
            'Coupon网站更新'=>'Admin\DataMonitorController@reportMerCoupon',
            'Coupon抓取监控'=>'Admin\DataMonitorController@catchMonitor',
            'Coupon点击命中率'=>'Admin\DataMonitorController@reportViewClick',
            'Coupon收益'=>'Admin\DataMonitorController@reportAffCommission',
        ]
    ],
    '广告联盟'=>[
        'icon'=>'fa-flask',
        'link'=>'#',

        'level'=>
        [
            '站群广告配置'=>'Admin\AffController@siteAds',
        ]

    ],
    '网站管理'=>[
        'icon'=>'fa-desktop',
        'link'=>'#',

        'level'=>
        [
            'coupon网站'=>'Admin\Web\CouponController@store',
        ]
    ],
    '小程序管理'=>[
        'icon'=>'fa-desktop',
        'link'=>'#',
        'level'=>
        [
            '心情语录'=>'Admin\AffController@siteAds',
        ]
    ],
    '系统日志'=>[
        'icon'=>'fa-bell',
        'link'=>'/admin/logs'
    ],


];