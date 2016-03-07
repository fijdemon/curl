<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/8 0008
 * Time: 上午 00:05:33
 */

namespace JustLogin;


class JustHttpHeader extends JustCore
{
    /**
     * @var string
     */
    private $url = '';


    /**
     * @var string 传输数据原始字符串
     */
    private $rawData = '';


    /**
     * @var array 传输数据数组
     */
    private $listData = array();


    public function __set($name, $value)
    {
        switch($name){
            case 'url':
                $this->setUrl($value);
                break;
            case 'data':
                $this->setData($value);
        }
    }


    /**
     * 设置url
     * @param $value
     */
    public function setUrl($value){
        $this->url = $value;
    }


    /**
     * 从新设置 data
     * @param $value
     */
    public function setData($value){
        $this->rawData = '';
        $this->synData("raw_to_list");
        $this->addData($value);
    }


    /**
     * 添加传入的参数
     * @param $data 传递的数组
     * @return $this
     */
    public function addData($data){
        // 添加字符串参数
        if(is_scalar($data)){
            $this->rawData .= "&".trim($data, '&?');
            $this->synData('raw_to_list');

        }
        // 添加数组参数
        elseif(is_array($data)){
            $this->listData = array_merge($data, $this->httpConfig['listData']);
            $this->synData('list_to_raw');
        }
        // 添加对象参数
        elseif(is_object($data)){
            $_d = get_object_vars($data);
            $this->data($_d);
        }
    }


    /**
     * 原始字符串和数据数据相互转变
     * @param string $method
     * @param bool $return 是否只是返回不写入
     * @return string
     */
    private function synData( $method = 'raw_to_list' ,$return = false){
        switch($method){
            case 'list_to_raw': // 数组同步到字符串
                $_tmp = http_build_query($this->listData);

                if($return)return $_tmp;

                $this->rawData = $_tmp;
                break;
            case 'raw_to_list': // 字符串同步到数组
                parse_str($this->rawData, $_tmp);

                if($return)return $_tmp;

                $this->listData = $_tmp;
                break;
            default:    // 内容多的覆盖少的，不冲突部分合并相互改变
                $_s = $this->synData('raw_to_list',true);
                $_t = $this->listData;
                $_a = count($_s)>count($_t) ? array_merge($_t, $_s) : array_merge($_s, $_t);

                if($return)return $_a;

                $this->listData = $_a;
                $this->synData('list_to_raw');
        }
    }
}