<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Dynasty extends Model
{
    //
    protected $table = 'dynasty';

    static $typeTang = 1;   //唐朝
    static $typeSong = 2;   //宋朝
}
