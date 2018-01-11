<?php
namespace DdvPhp\QQ;

class QPay extends \DdvPhp\QQ\QPay\QpayMchAPI
{
  // 魔术方法
  public function __construct($config = null)
  {
    parent::__construct();
    isset($config) && is_array($config) && $this->setConfig($config);
  }
  public function setConfig($config = null){
  	if (!is_array($config)) {
  		return;
  	}
  	if (!empty($config['appid'])) {
  		$this->setAppId($config['appid']);
  	}
  	if (!empty($config['appkey'])) {
  		$this->setAppKey($config['appkey']);
  	}
  	if (!empty($config['scope'])) {
  		$this->setScope($config['scope']);
  	}
  	if (!empty($config['openid'])) {
  		$this->setOpenid($config['openid']);
  	}
  	if (!empty($config['callback'])) {
  		$this->setCallbackUrl($config['callback']);
  	}
  	if (!empty($config['access_token'])) {
  		$this->setAccessToken($config['access_token']);
  	}
  }
}
