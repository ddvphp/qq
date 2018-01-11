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
  public function unifiedOrder($params = array()){
      // $params["out_trade_no"] = "20160512161914_BBC";
      // $params["sub_mch_id"] = "1900005911";
      // $params["body"] = "body_test_中文";
      // $params["device_info"] = "WP00000001";
      // $params["fee_type"] = "CNY";
      // $params["notify_url"] = "https://10.222.146.71:80/success.xml";
      // $params["spbill_create_ip"] = "127.0.0.1";
      // $params["total_fee"] = "1";
      // $params["trade_type"] = "NATIVE";

    //参数检测
    //实际业务中请校验参数，本demo略
    //
if (empty($params["out_trade_no"])){
    throw new Exception('xxxxdf' ,'OUT_TRADE_NO_MUST_INPUT');
}



    //api调用
      $this->setUrl('https://qpay.qq.com/cgi-bin/pay/qpay_unified_order.cgi');
      $this->setIsSSL(null);
      $this->setTimeout(10);
      $ret = $this->reqQpay($params);

      print_r(QpayMchUtil::xmlToArray($ret));
  }

}
