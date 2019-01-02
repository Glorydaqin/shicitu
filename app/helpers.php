<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/5
 * Time: 13:53
 */

/**
 * 二位数组去除重复值
 * @param $arr
 * @param $key
 * @return array
 */
function array_unset($arr,$key){   //$arr->传入数组   $key->判断的key值
    //建立一个目标数组
    $res = array();
    foreach ($arr as $value) {
        //查看有没有重复项
        if(isset($res[$value[$key]])){
            //有：销毁
            unset($value[$key]);
        }else{
            $res[$value[$key]] = $value;
        }
    }
    return $res;
}

/**
 * Encode array to utf8 recursively
 * 转码数组utf8
 * @param $dat
 * @return array|string
 */
function array_utf8_encode($dat)
{
    if (is_string($dat))
        return utf8_encode($dat);
    if (!is_array($dat))
        return $dat;
    $ret = array();
    foreach ($dat as $i => $d)
        $ret[$i] = array_utf8_encode($d);
    return $ret;
}


/**
 * html encoding transform
 * @param $html
 * @return mixed|null|string|string[]
 */
function encoding($html)
{
    $out = 'UTF-8';

//    $if = function_exists('mb_convert_encoding');
    if (function_exists('iconv'))
    {
        $func = 'iconv';
    }else
    {
        $func = 'mb_convert_encoding';
    }

    $pattern = '/(<meta[^>]*?charset=([\"\']?))([a-z\d_\-]*)(\2[^>]*?>)/is';
    $n = preg_match($pattern, $html, $in);
    if ($n > 0)
    {
        $in = $in[3];
    }
    else
    {
        $in = null;
    }
    if (empty($in) and function_exists('mb_detect_encoding'))
    {
        $in = mb_detect_encoding($html, array('UTF-8', 'GBK', 'GB2312', 'LATIN1', 'ASCII', 'BIG5', 'ISO-8859-1'));
    }

    if (isset($in))
    {
        if ($in == 'ISO-8859-1')
        {
            $in = 'UTF-8';
        }
        $old  = error_reporting(error_reporting() & ~E_NOTICE);
        $html = call_user_func($func, $in, $out.'//IGNORE', $html);
        error_reporting($old);
        $html = preg_replace($pattern, "\\1$out\\4", $html, 1);
    }
    return $html;
}

function memory_get_usage_trans()
{
    $size = memory_get_usage();
    $unit=array('b','kb','mb','gb','tb','pb');
    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
}

function array_get_locale($json){
    $locale = \App::getLocale()??'en';
    if(!is_array($json)){
        $json = json_decode($json,true);
    }
    return $json[$locale]??$json['en'];
}

function image_path($path='',$type = 'poster'){
    $realPath = \App\Model\MovieImageSource::where(['type'=>$type,'path'=>$path])
        ->first();
    if($realPath){
        return env('APP_STATIC_URL').$realPath['real_path'];
    }else{
        return '';
    }
}

function make_url($type,$id,$slug){
    $locale = \App::getLocale()??'en';

    if($type == 'movie'){
        $url = "/info/{$id}-{$slug}";
    }elseif($type == 'movieOnlineWatch'){
        $url = "/info/{$id}-{$slug}/watch";
    }elseif($type == 'genre'){
        $url = "/genre/{$id}-{$slug}";
    }else{
        $url = '';
    }

    return "/".$locale.$url;
}

function remove_locale(){
    return trim(str_replace(['/zh','/en'],[''],Request::getRequestUri()));
}


function proper_parse_str($str) {
    # result array
    $arr = array();

    # split on outer delimiter
    $pairs = explode('&', $str);

    # loop through each pair
    foreach ($pairs as $i) {
        # split into name and value
        list($name,$value) = explode('=', $i, 2);

        # if name already exists
        if( isset($arr[$name]) ) {
            # stick multiple values into an array
            if( is_array($arr[$name]) ) {
                $arr[$name][] = urldecode($value);
            }
            else {
                $arr[$name] = array($arr[$name], urldecode($value));
            }
        }
        # otherwise, simply stick it in a scalar
        else {
            $arr[$name] = urldecode($value);
        }
    }

    # return result array
    return $arr;
}

function getBtQuantity($str){
    $mapping = [
        "蓝光原盘/BluRay"   => "BluRay",
        "Remux"             => "Remux",
        "4K"                => "4K",
        "BluRay-1080P"      => "BluRay-1080P",
        "BluRay-3D"         => "BluRay-3D",
        "BluRay-720P"       => "BluRay-720P",
        "HDTV/HDRip/DVDRip" => "HDTV/HDRip/DVDRip",
        "WEB-1080P"         => "WEB-1080P",
        "WEB-720P"          => "WEB-720P",
        "TS/CAM/HC/DVDScr"  => "TS/CAM/HC/DVDScr",
    ];
//    BluRay > Remux > 4K >
    $find = false;
    foreach ($mapping as $key=>$item){
        if(strripos(' '.$key,$str)){
            return $item;
        }
    }
    if(!$find){
        return $mapping[count($mapping)-1];
    }
}



/**
 * 字符串半角和全角间相互转换
 * @param string $str  待转换的字符串
 * @param string $type  TODBC:转换为半角；TOSBC，转换为全角
 * @return string  返回转换后的字符串
 */
function convertStrType($str, $type) {

    $dbc = array(
        '０' , '１' , '２' , '３' , '４' ,
        '５' , '６' , '７' , '８' , '９' ,
        'Ａ' , 'Ｂ' , 'Ｃ' , 'Ｄ' , 'Ｅ' ,
        'Ｆ' , 'Ｇ' , 'Ｈ' , 'Ｉ' , 'Ｊ' ,
        'Ｋ' , 'Ｌ' , 'Ｍ' , 'Ｎ' , 'Ｏ' ,
        'Ｐ' , 'Ｑ' , 'Ｒ' , 'Ｓ' , 'Ｔ' ,
        'Ｕ' , 'Ｖ' , 'Ｗ' , 'Ｘ' , 'Ｙ' ,
        'Ｚ' , 'ａ' , 'ｂ' , 'ｃ' , 'ｄ' ,
        'ｅ' , 'ｆ' , 'ｇ' , 'ｈ' , 'ｉ' ,
        'ｊ' , 'ｋ' , 'ｌ' , 'ｍ' , 'ｎ' ,
        'ｏ' , 'ｐ' , 'ｑ' , 'ｒ' , 'ｓ' ,
        'ｔ' , 'ｕ' , 'ｖ' , 'ｗ' , 'ｘ' ,
        'ｙ' , 'ｚ' , '－' , '　'  , '：' ,
        '．' , '，' , '／' , '％' , '＃' ,
        '！' , '＠' , '＆' , '（' , '）' ,
        '＜' , '＞' , '＂' , '＇' , '？' ,
        '［' , '］' , '｛' , '｝' , '＼' ,
        '｜' , '＋' , '＝' , '＿' , '＾' ,
        '￥' , '￣' , '｀'

    );

    $sbc = array( //半角
        '0', '1', '2', '3', '4',
        '5', '6', '7', '8', '9',
        'A', 'B', 'C', 'D', 'E',
        'F', 'G', 'H', 'I', 'J',
        'K', 'L', 'M', 'N', 'O',
        'P', 'Q', 'R', 'S', 'T',
        'U', 'V', 'W', 'X', 'Y',
        'Z', 'a', 'b', 'c', 'd',
        'e', 'f', 'g', 'h', 'i',
        'j', 'k', 'l', 'm', 'n',
        'o', 'p', 'q', 'r', 's',
        't', 'u', 'v', 'w', 'x',
        'y', 'z', '-', ' ', ':',
        '.', ',', '/', '%', ' #',
        '!', '@', '&', '(', ')',
        '<', '>', '"', '\'','?',
        '[', ']', '{', '}', '\\',
        '|', '+', '=', '_', '^',
        '￥','~', '`'

    );
    if($type == 'TODBC'){
        return str_replace( $sbc, $dbc, $str );  //半角到全角
    }elseif($type == 'TOSBC'){
        return str_replace( $dbc, $sbc, $str );  //全角到半角
    }else{
        return $str;
    }
}