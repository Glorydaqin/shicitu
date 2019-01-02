<?php
/**
 * Created by PhpStorm.
 * User: daqin
 * Date: 2018/12/22
 * Time: 20:53
 */

namespace App\Utils;


class CodeCompress
{
    // usage: echo charCodeAt("This is a string", 7)
    static function charCodeAt($str, $i){
        return ord(substr($str, $i, 1));
    }

// usage: echo fromCharCode(72, 69, 76, 76, 79)
    static function fromCharCode(){
        return array_reduce(func_get_args(),function($a,$b){$a.=chr($b);return $a;});
    }

    /**
     * 解密
     * @param $str
     * @return mixed|string
     */
    static function unCompileCode($str){
        $str = base64_decode($str);
        for (
            $t = self::fromCharCode(
                self::charCodeAt($str,0) - strlen($str)
            ),$o = 1;
            $o < strlen($str);
            $o++
        ){
            $t .= self::fromCharCode(
                self::charCodeAt($str,$o) - self::charCodeAt($t,$o-1)
            );
        }
        return $t;
    }

    /**
     * 加密
     * @param $str
     * @return mixed|string
     */
    static function compileCode($str){
        $tmp = self::fromCharCode(self::charCodeAt($str,0) + strlen($str));
        for ($i = 1;$i<strlen($str);$i++){
            $tmp .= self::fromCharCode(
                self::charCodeAt($str,$i)+self::charCodeAt($str,$i-1)
            );
        }
        $tmp = base64_encode($tmp);
        return $tmp;
    }

}