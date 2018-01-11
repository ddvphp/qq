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
  	if (!empty($config['mchId'])) {
  		$this->setMchId($config['mchId']);
  	}
  	if (!empty($config['subMchId'])) {
  		$this->setSubMchId($config['subMchId']);
  	}
  	if (!empty($config['mchKey'])) {
  		$this->setMchKey($config['mchKey']);
  	}
  	if (!empty($config['certFilePath'])) {
  		$this->setCertFilePath($config['certFilePath']);
  	}
  	if (!empty($config['keyFilePath'])) {
  		$this->setKeyFilePath($config['keyFilePath']);
  	}
  }

}
