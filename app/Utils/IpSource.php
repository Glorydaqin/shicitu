<?php
/**
 * Created by PhpStorm.
 * User: 69286
 * Date: 2018/7/3
 * Time: 21:09
 */

namespace App\Utils;


use Illuminate\Support\Facades\Log;

class IpSource
{
    static public $domain = 'http://118.24.1.122:8080';

    /**
     * 获取新ip
     * @param $source_id
     * @return string
     */
    static public function get_ip($source_id)
    {
        try{
            $ip = file_get_contents(self::$domain."/get_ip/{$source_id}");
            return $ip;
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            return '';
        }
    }

    /**
     * 设置ip不可用
     * @param $source_id
     * @param $ip
     * @return bool
     */
    public static function set_ip_fail($source_id,$ip)
    {
        self::set_ip($source_id,$ip,'fail');
        return true;
    }


    /**
     * 设置ip可用
     * @param $source_id
     * @param $ip
     * @return bool
     */
    public static function set_ip_success($source_id,$ip)
    {
        return self::set_ip($source_id,$ip,'success');
    }

    private static function set_ip($source_id,$ip,$status)
    {
        if(!empty($source_id) && !empty($ip) && !empty($status)){
            try{
                return file_get_contents(self::$domain."/set_ip/{$source_id}/{$ip}/{$status}");
            }catch (\Exception $exception){
                return false;
            }
        }else{
            return false;
        }
    }
}