<?php
namespace DdvPhp\QQ\QPay;
/**
 * qpayMachAPI.php 业务调用方可做二次封装
 * Created by HelloWorld
 * vers: v1.0.0
 * User: Tencent.com
 */
class QpayMchAPI{
    protected $url;
    protected $isSSL;
    protected $timeout;
    /**
     * QQ钱包商户号
     */
    protected $mchId = '';
    /**
     * 子商户号
     */
    protected $subMchId = '';
    /**
     * API密钥。
     * QQ钱包商户平台(http://qpay.qq.com/)获取
     */
    protected $mchKey = '';

    public function  setMchId($mchId){
        $this->mchId = $mchId;
    }
    public function setSubMchId($subMchId){
        $this->subMchId = $subMchId;
    }
    public function setMchKey($mchKey){
        $this->mchKey = $mchKey;
    }
    /**
     * QpayMchAPI constructor.
     *
     * @param       $url       接口url
     * @param       $isSSL     是否使用证书发送请求
     * @param int   $timeout   超时
     */
    public function __construct($url, $isSSL, $timeout = 5){
        $this->url = $url;
        $this->isSSL = $isSSL;
        $this->timeout = $timeout;
    }

    public function reqQpay($params){
        $ret = array();
        //商户号
        $params["mch_id"] = $this->mchId;
        //随机字符串
        $params["nonce_str"] = QpayMchUtil::createNoncestr();
        //签名
        $params["sign"] = QpayMchUtil::getSign($params, $this->mchKey);
        //生成xml
        $xml = QpayMchUtil::arrayToXml($params);

        if(isset($this->isSSL)){
            $ret =  QpayMchUtil::reqByCurlSSLPost($xml, $this->url, $this->timeout);
        }else{
            $ret =  QpayMchUtil::reqByCurlNormalPost($xml, $this->url, $this->timeout);
        }
        return $ret;
    }

}