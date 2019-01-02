<?php
/**
 * Created by PhpStorm.
 * User: qw
 * Date: 2018/9/18
 * Time: 23:50
 */

namespace App\Utils;


class Tool
{

    static function arrayGetLocale($json){
        $locale = \App::getLocale()??'en';
        if(!is_array($json)){
            $json = json_decode($json,true);
        }
        return $json[$locale];
    }
}