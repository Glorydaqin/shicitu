<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    //
    public function index(){
        return view('web.index');
    }

    public function search(){
        return view('web.search');
    }

    public function list(){
        return view('web.list');
    }

    public function poetry(){
        return view('web.poetryDetail');
    }
}
