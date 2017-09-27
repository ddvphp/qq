<?php
namespace DdvPhp\QQ;

class Connect extends \DdvPhp\QQ\Connect\QC
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
  		$this->setAppId($appid);
  	}
  	if (!empty($config['scope'])) {
  		$this->setScope($scope);
  	}
  	if (!empty($config['openid'])) {
  		$this->setOpenid($openid);
  	}
  	if (!empty($config['callback'])) {
  		$this->setCallbackUrl($callback);
  	}
  	if (!empty($config['access_token'])) {
  		$this->setAccessToken($access_token);
  	}
  }
}
