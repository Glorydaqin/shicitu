<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $locale = $request->segment(1);

        $cookieLocaleKey = 'locale';
        if(Cookie::get($cookieLocaleKey)){
            //第二次进来
            if(!in_array($locale,['zh','en'])){
                $locale = Cookie::get($cookieLocaleKey);
            }
        }else{
            //第一次进来
            if(!in_array($locale,['zh','en'])){

                //根据浏览器设置语言选择跳转
                if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
                    $http_accept_language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];

                    $http_language = strtolower( strtok( $http_accept_language, ',' ) );
                    if ($http_language == 'zh-cn' || $http_language == 'zh-hans-cn' || $http_language == 'zh-sg' || $http_language == 'zh-hans-sg' || $http_language == 'zh') {
                        $http_language = 'zh-hans'; //简体中文
                    } elseif ($http_language == 'zh-tw' || $http_language == 'zh-hant-tw' || $http_language == 'zh-hk' || $http_language == 'zh-hant-hk') {
                        $http_language = 'zh-hant'; //繁体中文
                    }
                    if($http_language == 'zh-hans' || $http_language=='zh-hant'){
                        $locale = 'zh';
                    }else{
                        $locale = 'en';
                    }
                } else {
                    $locale = 'zh';
                }
            }
            \View::share('isFirst',true);
        }
        \App::setLocale($locale);
        Cookie::make($cookieLocaleKey,$locale, 60*24*31);

        return $next($request);

    }
}
