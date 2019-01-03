<?php

namespace App\Http\Controllers\Api;

use App\Model\Author;
use App\Model\Poetry;
use App\Module\AuthorModule;
use App\Module\PoetryModule;
use App\Module\TypeModule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class PoetryController extends Controller
{
    //首页推荐
    public function recommend()
    {
        $list = PoetryModule::recommend(3);
        return ['code'=>0,'data'=>$list,'message'=>"success"];
    }

    public function search()
    {
        
    }

    public function getTypeList()
    {
        $list = TypeModule::getList();
        return ['code'=>0,'data'=>$list,'message'=>"success"];
    }

    public function getAuthorList()
    {
        $perPage = 20;
        $page = Input::get("page",1);
        $list = AuthorModule::getList($page,$perPage);
        return ['code'=>0,'data'=>['pageNo'=>$page, 'pageSize'=>$perPage, 'data'=> $list],'message'=>"success"];
    }

    public function getDynastyList()
    {

    }

    public function getPoetryList()
    {

    }

    public function getPoetryDetail()
    {
        $id = Input::get('id');
        $detail = Poetry::where("id",$id)->first();
        if(!$detail)
            return ['code'=>1,'data'=>[],'message'=>'cannot find data with id:'.$id];

        return ['code'=>0,'data'=>$detail,'message'=>'success'];
    }
}
