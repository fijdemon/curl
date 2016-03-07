<?php
/**
 * Created by PhpStorm.
 * User: fijdemon
 * Date: 2016/3/7 0007
 * Time: 下午 22:37:18
 */

namespace JustLogin;

/**
 * Class JustLogin
 * @package JustLogin\JustLogin
 */
class JustLogin extends JustCore
{
    /**
     * @var null 保存 header 数据
     */
    protected $httpHeader = NULL;


    /**
     * JustLogin constructor.
     */
    public function __construct()
    {
        $this->httpHeader = new JustHttpHeader();
    }


    /**
     * 设置url地址
     * @param string $url 设置url
     * @return $this
     */
    public function url($url){
        $this->httpHeader->setUrl( $url);
        return $this;
    }


    /**
     * 设置传入的参数
     * @param $data 传递的数组
     * @return $this
     */
    public function data($data){
        $this->httpHeader->setData($data);
        return $this;
    }


    /**
     * post 请求
     */
    public function post(){

    }


    /**
     * get 请求
     */
    public function get(){

    }
}

