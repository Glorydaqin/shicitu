<?php
/**
 * Created by PhpStorm.
 * User: qw
 * Date: 2019/1/2
 * Time: 22:36
 */

namespace App\Module;


use App\Model\Poetry;
use App\Model\Type;

class TypeModule
{
    public static function getList()
    {
        return Type::get();
    }
}