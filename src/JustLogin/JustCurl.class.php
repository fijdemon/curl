<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/8 0008
 * Time: 下午 23:19:23
 */

namespace JustLogin;


class JustCurl extends JustCore
{
    const GET = 'get';
    const POST = 'post';


    /**
     * get方式获取内容
     * @param $url
     * @param $cookie
     * @param $referer
     * @param $timeout
     */
    public function get($url, $cookie='', $referer='', $timeout=30){

    }



    public function post($url, $data, $cookie='', $referer='', $timeout=30){

    }


    /**
     * curl函数
     * @param string $method
     * @param string $url
     * @param string $data
     * @param bool $header
     * @param string $cookie
     * @param string $referer
     * @param int $timeout
     * @return mixed number
     */
    protected function request($url, $data='', $method=self::GET, $header=false, $cookie="", $referer='', $timeout=30){ // 模拟获取内容函数
        $ch = curl_init();		//初始化curl
        curl_setopt($ch, CURLOPT_URL, $url);	//设置访问url

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

        //if( !$cookie)
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 3);	//设置调用超时时间

        if($method == self::POST){
            curl_setopt($ch, CURLOPT_POST, 1);		//使用post方式
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);		//设置post参数
        }

        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);		//设置http版本

        curl_setopt($ch, CURLOPT_USERAGENT, " Mozilla/5.0 (Windows NT 6.1; rv:22.0) Gecko/20100101 Firefox/22.0");
        curl_setopt($ch, CURLOPT_COOKIE, $cookie);	// cookie
        curl_setopt($ch, CURLOPT_REFERER, $referer);	// 设置referer
        if($header)
            curl_setopt($ch, CURLOPT_HEADER, 1);// 设置返回头信息流

        // 		curl_setopt($ch,CURLOPT_HTTPHEADER,array(
        // 		'Connection: keep-alive'
        // 				,'Accept-Language: zh-cn,zh;q=0.8,en-us;q=0.5,en;q=0.3'
        // 				,'Accept-Encoding: gzip, deflate'
        // 						));

        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);		//设置超时时间
        $re = curl_exec($ch);		//执行curl，获取返回值
        $info = curl_getinfo($ch);	//获取curl执行时相关信息
        $errNo = curl_errno($ch);	//获取curl错误码

        curl_close($ch);				//关闭curl
        return array('res' => $re, 'info' => $info, 'errno' => $errNo);
    }
}