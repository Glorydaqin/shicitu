<?php
/**
 * Created by PhpStorm.
 * User: qw
 * Date: 2019/1/2
 * Time: 22:36
 */

namespace App\Module;


use App\Model\Dynasty;

class DynastyModule
{
    public static function getList()
    {
        return Dynasty::get();
    }
}