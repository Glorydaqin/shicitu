<?php
/**
 * Created by PhpStorm.
 * User: qw
 * Date: 2018/8/16
 * Time: 16:52
 */

namespace App\Utils;


class Curl
{
    //返回随机Agent
    static function getAgent(){
        $agentArray=array(
            "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0",
            "Mozilla/5.0 (Windows NT 6.1; rv:12.0) Gecko/20100101 Firefox/12.0",
            "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.11 TaoBrowser/2.0 Safari/536.11",
            "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.71 Safari/537.1 LBBROWSER",
            "Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E; LBBROWSER)",
            "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; QQDownload 732; .NET4.0C; .NET4.0E; LBBROWSER)",
            "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.84 Safari/535.11 LBBROWSER",
            "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; WOW64; Trident/5.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)",
            "Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E; QQBrowser/7.0.3698.400)",
            "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; QQDownload 732; .NET4.0C; .NET4.0E)",
            "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Trident/4.0; SV1; QQDownload 732; .NET4.0C; .NET4.0E; 360SE)",
            "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; QQDownload 732; .NET4.0C; .NET4.0E)",
            "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; WOW64; Trident/5.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)",
            "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.89 Safari/537.1",
            "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.89 Safari/537.1",
            "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; QQDownload 732; .NET4.0C; .NET4.0E)",
            "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; WOW64; Trident/5.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)",
            "Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)",
            "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.84 Safari/535.11 SE 2.X MetaSr 1.0",
            "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Trident/4.0; SV1; QQDownload 732; .NET4.0C; .NET4.0E; SE 2.X MetaSr 1.0)",
            "Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:16.0) Gecko/20121026 Firefox/16.0"
        );
        $ind=rand(0, count($agentArray)-1);
        return  $agentArray[$ind];
    }

    static function get($url,$ipInfo = '',$header =[]){
        return self::request($url,$ipInfo,'',$header);
    }

    static function post($url,$ipInfo='',$data='',$header = []){
        return self::request($url,$ipInfo,$data,$header);
    }

    static function getRefer($url){
        $urlArr = parse_url($url);
        if(isset($urlArr['host']) && !empty($urlArr['host'])){
            return "http://".$urlArr['host'];
        }
        return "http://google.com";
    }

    static function request($url,$ip_info="",$data='',$headers=array()){
        $source_url = self::getRefer($url);
        $ch = curl_init();

        $user_agent = self::getAgent();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT,25);   //只需要设置一个秒的数量就可以
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_REFERER, $source_url);//这里写一个来源地址，可以写要抓的页面的首页
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        if(!empty($ip_info)){
            curl_setopt($ch,CURLOPT_PROXY,$ip_info);
        }
//        $cookie_file=DIR_TMP_COOKIE.rand(1000,5000).".txt";
//        if(!file_exists($cookie_file)){
//            file_put_contents($cookie_file, "");
//        }
        if(!empty($data)){
            // post数据
            curl_setopt($ch, CURLOPT_POST, 1);
            // post的变量
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        if(!empty($headers)){
            // headers
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
//        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
//        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
        $content=curl_exec($ch);

        $httpCode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
        $res = curl_getinfo($ch);
        curl_close ($ch);
        $r=array();
        $r['http_code']=$httpCode;
        $r['url']=$res['url'];
        $r['body']= encoding($content);

        return $r;
    }

    /**
     * 请求两次
     * @param $url
     * @param string $ip_info
     * @param string $data
     * @param array $headers
     * @return array
     */
    static function getTwice($url,$ip_info="",$data='',$headers=array()){
        $source_url = self::getRefer($url);
        $ch = curl_init();

        $user_agent = self::getAgent();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT,25);   //只需要设置一个秒的数量就可以
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_REFERER, $source_url);//这里写一个来源地址，可以写要抓的页面的首页
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        if(!empty($ip_info)){
            curl_setopt($ch,CURLOPT_PROXY,$ip_info);
        }
        $cookieFile = storage_path('cookies/'.rand(1,1000).'.txt');
        if(!file_exists($cookieFile)){
            file_put_contents($cookieFile, "");
        }
        if(!empty($data)){
            // post数据
            curl_setopt($ch, CURLOPT_POST, 1);
            // post的变量
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        if(!empty($headers)){
            // headers
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
        curl_exec($ch);

        //第二次请求
        sleep(1);
        $content=curl_exec($ch);

        $httpCode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
        $res = curl_getinfo($ch);
        curl_close ($ch);
        $r=array();
        $r['http_code']=$httpCode;
        $r['url']=$res['url'];
        $r['body']=$content;

        return $r;
    }
}