<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    //
    protected $table = 'type';

    static $typeTang = 1;   //唐诗
    static $typeSong = 2;   //宋词

}
