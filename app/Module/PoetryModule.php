<?php
/**
 * Created by PhpStorm.
 * User: qw
 * Date: 2019/1/2
 * Time: 22:36
 */

namespace App\Module;


use App\Model\Poetry;

class PoetryModule
{
    public static function totalRandom($leftPx = 0)
    {
        $total = Poetry::count();
        return rand(0,$total - $leftPx);
    }


    public static function recommend($limit)
    {
        $offset = self::totalRandom($limit);
        $list = Poetry::skip($offset)->take($limit)->get();
        foreach ($list as &$value){
            $value['paragraphs'] = json_decode($value['paragraphs'],true);
            $value['strains'] = json_decode($value['strains'],true);
        }
        return $list;
    }
}