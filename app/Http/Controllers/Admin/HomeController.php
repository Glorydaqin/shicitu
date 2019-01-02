<?php

namespace App\Http\Controllers\Admin;

use App\Model\Aff\AffCommission;
use App\Model\CpCompetitor;
use App\Model\CpCompetitorStore;
use App\Model\CpTempCompetitorStore;
use App\Model\ReportCouponNum;
use App\Model\ReportMerCoupon;
use App\Model\ReportViewClick;
use App\Module\Content\CpCompetitorModule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    //
    public function index(){

        //数据监控
        $reportCatchNum= $this->reportCatchCoupon();
        //临时表
        $tempDeal=$this->tempDealTable();
        //网站更新率
        $reportMerCoupon=$this->reportMerCoupon();
        //日展示点击
        $reportViewClick=$this->viewClick();
        //收益
        $revenue=$this->reportCpRevenue();

        return view('admin.home',compact('tempDeal','reportMerCoupon','reportCatchNum','reportViewClick','revenue'));
    }

    public function reportCpRevenue()
    {
        //coupon站点收益
        $today=date("Y-m-d");
        $yesterday=date("Y-m-d",strtotime('-1 day'));
        $weekBefore=date("Y-m-d",strtotime("-7 day"));
        $monthBefore=date("Y-m-d",strtotime("-1 month"));
        $yesterdayRevenue=AffCommission::where("VisitTime",'>',$yesterday)->sum("Money");
        $weekRevenue=AffCommission::whereBetween("VisitTime",[$weekBefore,$today])->sum("Money");
        $monthRevenue=AffCommission::whereBetween("VisitTime",[$monthBefore,$today])->sum("Money");
        return compact('yesterdayRevenue','weekRevenue','monthRevenue');
    }

    //日展示点击
    public function viewClick()
    {
        return ReportViewClick::orderBy('date','desc')->first();
    }

    public function tempDealTable(){
        //临时表汇总信息
        $competitorId=CpCompetitorStore::groupBy("CompetitorId")->select('CompetitorId',DB::raw('count(CompetitorId) as num'))->get();
        $competitor=CpCompetitor::whereIn('ID',$competitorId->pluck('CompetitorId'))->select('ID','Url','Country','ShowText')->get();
        $dealTempCompetitorStore=CpTempCompetitorStore::groupBy("CompetitorId")
            ->where("CompetitorStoreId",'<',1)
            ->where("StoreId",'<',1)
            ->where('Status','!=','Delete')->select('CompetitorId',DB::raw('count(CompetitorId) as num'))->get();

        foreach ($competitor as $item){
            foreach ($competitorId as $value){
                if($item->ID == $value->CompetitorId){
                    $item->num=$value->num;
                }
            }
            foreach ($dealTempCompetitorStore as $deal){
                if($item->ID == $deal->CompetitorId){
                    $item->dealNum=$deal->num;
                }
            }
        }
        return $competitor;
    }

    public function reportMerCoupon()
    {
        return  ReportMerCoupon::orderBy('AddTime','desc')->paginate(10);

    }

    public function reportCatchCoupon()
    {
        $date = date("Y-m-d");

        $list = [];
        $list[$date] = CpCompetitorModule::getCatchInfo($date);
        return $list;
    }


    public function upFile()
    {
        //图片上传七牛接口
        $cb = $_GET['CKEditorFuncNum']; //获得ck的回调id

        if(isset($_FILES['upload'])){

            $tmp = explode(".",$_FILES['upload']['name']);
            $count_tmp = count($tmp);
            $imgName = "store_desc/".date("ymdH-").uniqid().'.'.$tmp[$count_tmp-1];

            $disk = Storage::disk('ftp');
            // create a file
            $imgContent = file_get_contents($_FILES['upload']['tmp_name']);

            if($disk->put($imgName,$imgContent)){
                //上传成功
                $url = "https://cdn.promosgo.com/{$imgName}";
                return "<script>window.parent.CKEDITOR.tools.callFunction({$cb}, '{$url}', '');</script>";
            }else{
                return "<script>window.parent.CKEDITOR.tools.callFunction({$cb}, '', '上传失败');</script>";
            }
        }else{
            return "<script>window.parent.CKEDITOR.tools.callFunction({$cb}, '', '请选择文件');</script>";
        }


    }

}
