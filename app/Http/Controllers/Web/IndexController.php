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
        return view('web.info',compact('item'));
    }
}
