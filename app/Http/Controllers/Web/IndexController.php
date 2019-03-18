<?php

namespace App\Http\Controllers\Web;

use App\Model\Poetry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    //
    public function index(){
        $list = Poetry::paginate();

        return view('web.index',compact('list'));
    }

    public function search(){
        return view('web.search');
    }

    public function list(){
        return view('web.list');
    }

    public function info($id){
        $item = Poetry::where("id",$id)->first();

        //抓取数据,补全解释
        $this->curlSave($item);
        return view('web.info',compact('item'));
    }

    private function curlSave($info){
        $listUrl = "https://gushi.weixinshop.cc/api.php/ApiSearch/index?s_keyword=".urlencode($info['title'])."&utoken=4d6a073ec14d2b00af435b8a2a0a116d";

        $id = '';
        $contentUrl = 'https://gushi.weixinshop.cc/api.php/ShiApi/info?id='.$id.'&utoken=4d6a073ec14d2b00af435b8a2a0a116d&tdsourcetag=s_pctim_aiomsg';
        dd($listUrl);
    }
}
