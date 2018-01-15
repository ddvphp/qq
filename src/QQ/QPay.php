<?php
namespace DdvPhp\QQ;

use DdvPhp\QQ\QPay\QpayMchAPI;
use DdvPhp\QQ\QPay\QpayMchUtil;

class QPay extends \DdvPhp\QQ\QPay\QpayMchAPI
{
  // 魔术方法
  public function __construct($config = null)
  {

    parent::__construct($this->url,$this->isSSL,$this->timeout);
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

    /**
     * 统一下单接口
     * @param array $params
     * @throws Exception
     */
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
      if (empty($params["fee_type"])){
          throw new Exception('xxxxdf' ,'OUT_TRADE_NO_MUST_INPUT');
      }
      if (empty($params["total_fee"])){
          throw new Exception('xxxxdf' ,'OUT_TRADE_NO_MUST_INPUT');
      }
      if (empty($params["spbill_create_ip"])){
          throw new Exception('xxxxdf' ,'OUT_TRADE_NO_MUST_INPUT');
      }
      if (empty($params["device_info"])){
          throw new Exception('xxxxdf' ,'OUT_TRADE_NO_MUST_INPUT');
      }
      if (empty($params["auth_code"])){
          throw new Exception('xxxxdf' ,'OUT_TRADE_NO_MUST_INPUT');
      }

      //api调用
      $this->setUrl('https://qpay.qq.com/cgi-bin/pay/qpay_unified_order.cgi');
      $this->setIsSSL(null);
      $this->setTimeout(10);
      $ret = $this->reqQpay($params);

      return QpayMchUtil::xmlToArray($ret);
  }

    /**扫码下单
     * @param array $params
     * @throws Exception
     */
  public function QPayMicroPay($params = array()){
      //入参q
/*      $params["out_trade_no"] = "20160512161914_BBC" . "A";
      $params["sub_mch_id"] = "1900005911";
      $params["body"] = "body_test_中文";
      $params["device_info"] = "WP00000001";
      $params["fee_type"] = "CNY";
      $params["notify_url"] = "https://10.222.146.71:80/success.xml";
      $params["spbill_create_ip"] = "127.0.0.1";
      $params["total_fee"] = "1";
      $params["trade_type"] = "MICROPAY";
      $params["auth_code"] = "910728310408849937";*/
      if (empty($params["out_trade_no"])){
          throw new Exception('商户订单号参数不能缺少' ,'OUT_TRADE_NO_MUST_INPUT');
      }
      if (empty($params["fee_type"])){
          throw new Exception('货币类型不能缺少' ,'FEE_TYPE');
      }
      if (empty($params["total_fee"])){
          throw new Exception('订单金额不能缺少' ,'TOTAL_FEE');
      }
      if (empty($params["spbill_create_ip"])){
          throw new Exception('终端IP不能缺少' ,'SPBILL_CREATE_IP');
      }
      if (empty($params["device_info"])){
          throw new Exception('设备号不能缺少' ,'DEVICE_INFO');
      }
      if (empty($params["auth_code"])){
          throw new Exception('付款码不能缺少' ,'AUTH_CODE');
      }
/*      if (empty($params["sub_mch_id"])){
          throw new Exception('' ,'SUB_MCH_ID');
      }*/
/*      if (empty($params["notify_url"])){
          throw new Exception('' ,'NOTIFY_URL');
      }*/
      if (empty($params["body"])){
          throw new Exception('商品描述' ,'BODY');
      }
      if (empty($params["trade_type"])){
          throw new Exception('支付场景不能缺少' ,'TRADE_TYPE');
      }
    //api调用
      $qpayApi = new QpayMchAPI('https://qpay.qq.com/cgi-bin/pay/qpay_micro_pay.cgi', null, 10);
      $qpayApi->setMchId($params['mchId']);
      $qpayApi->setMchKey($params['mchKey']);
      unset($params['mchId'], $params['mchKey']);
      $ret = $qpayApi->reqQpay($params);

      return QpayMchUtil::xmlToArray($ret);
    }

    /**关闭订单
     * @param array $params
     * @return array|mixed|object
     * @throws Exception
     */
    public function QPayCloseOrder($params = array()){
/*        //入参
        $params = array();
        $params["out_trade_no"] = "20160512161914_BBC";
        $params["sub_mch_id"] = "1900005911";
        $params["op_user_id"] = "1900005911";
        $params["op_user_passwd"] = "";*/
        if (empty($params["out_trade_no"])){
            throw new Exception('商户订单号参数不能缺少' ,'OUT_TRADE_NO_MUST_INPUT');
        }
        if (empty($params["sub_mch_id"])){
            throw new Exception('sub_mch_id不能缺少' ,'FEE_TYPE');
        }
        if (empty($params["op_user_id"])){
            throw new Exception('操作员账号不能缺少' ,'TOTAL_FEE');
        }
        if (empty($params["op_user_passwd"])){
            throw new Exception('操作员密码不能缺少' ,'OP_USER_PASSWD_NOT_FOUND');
        }
        //api调用
        $qpayApi = new QpayMchAPI('https://qpay.qq.com/cgi-bin/pay/qpay_close_order.cgi', true, 10);
        $qpayApi->setMchId('1490434181');
        $qpayApi->setMchKey('8525638f86969d1de5c51ad0494f4f13');
        $qpayApi->setIsSSL(true);
        $qpayApi->setCertFilePath('/Users/aji/documents/Project/sicmouse-api/app/apiclient_cert.pem');
        $qpayApi->setKeyFilePath('/Users/aji/documents/Project/sicmouse-api/app/apiclient_key.pem');
        $ret = $qpayApi->reqQpay($params);
        return QpayMchUtil::xmlToArray($ret);
    }

    /**
     * 查询订单
     * @param array $params
     * @return array|mixed|object
     * @throws Exception
     */
    public function QPayOrderQuery($params = array()){
        /*        //入参
                $params = array();
                $params["out_trade_no"] = "20160512161914_BBC";
                $params["sub_mch_id"] = "1900005911";*/
        if (empty($params["out_trade_no"])){
            throw new Exception('商户订单号参数不能缺少' ,'OUT_TRADE_NO_MUST_INPUT');
        }
        if (empty($params["sub_mch_id"])){
            throw new Exception('sub_mch_id不能缺少' ,'FEE_TYPE');
        }

        //api调用
        $qpayApi = new QpayMchAPI('https://qpay.qq.com/cgi-bin/pay/qpay_order_query.cgi', null, 10);
        $qpayApi->setMchId('1490434181');
        $qpayApi->setMchKey('8525638f86969d1de5c51ad0494f4f13');
        $ret = $qpayApi->reqQpay($params);
        return QpayMchUtil::xmlToArray($ret);
    }

    /**
     * 申请退款
     * @param array $params
     * @return array|mixed|object
     * @throws Exception
     */
    public function QPayRefund($params = array()){
        /*  入参
            $params = array();
            $params["out_trade_no"] = "20160512161914_BBC";
            $params["sub_mch_id"] = "1900005911";
            $params["out_refund_no"] = "20160512161914_BBC_out_refund_1";
            $params["refund_fee"] = "99999";
            $params["op_user_id"] = "1900005911";
            $params["op_user_passwd"] = "";*/
        if (empty($params["out_trade_no"])){
            throw new Exception('商户订单号参数不能缺少' ,'OUT_TRADE_NO_MUST_INPUT');
        }
//        if (empty($params["sub_mch_id"])){
//            throw new Exception('货币类型不能缺少' ,'FEE_TYPE');
//        }
        if (empty($params["op_user_id"])){
            throw new Exception('订单金额不能缺少' ,'TOTAL_FEE');
        }
        if (empty($params["op_user_passwd"])){
            throw new Exception('终端IP不能缺少' ,'SPBILL_CREATE_IP');
        }
        if (empty($params["out_refund_no"])){
            throw new Exception('退款单号能缺少' ,'SPBILL_CREATE_IP');
        }
        if (empty($params["refund_fee"])){
            throw new Exception('退款金额不能缺少' ,'SPBILL_CREATE_IP');
        }
        //api调用
        $qpayApi = new QpayMchAPI('https://api.qpay.qq.com/cgi-bin/pay/qpay_refund.cgi', true, 10);
        $qpayApi->setMchId($params['mchId']);
        $qpayApi->setMchKey('8525638f86969d1de5c51ad0494f4f13');
        $qpayApi->setIsSSL(true);
        $qpayApi->setCertFilePath('/Users/aji/documents/Project/sicmouse-api/app/apiclient_cert.pem');
        $qpayApi->setKeyFilePath('/Users/aji/documents/Project/sicmouse-api/app/apiclient_key.pem');
        $ret = $qpayApi->reqQpay($params);
        return QpayMchUtil::xmlToArray($ret);
    }

    /**
     * 撤销订单
     * @param array $params
     * @return array|mixed|object
     * @throws Exception
     */
    public function QPayReverse($params = array()){
        /*       //入参
                $params = array();
                $params["out_trade_no"] = "20160512161914_BBC";
                $params["sub_mch_id"] = "1900005911";*/
        if (empty($params["out_trade_no"])){
            throw new Exception('商户订单号参数不能缺少' ,'OUT_TRADE_NO_MUST_INPUT');
        }
        if (empty($params["sub_mch_id"])){
            throw new Exception('不能缺少' ,'SUB_MCH_ID');
        }

        //api调用
        $qpayApi = new QpayMchAPI('https://api.qpay.qq.com/cgi-bin/pay/qpay_reverse.cgi', true, 10);
        $qpayApi->setMchId('1490434181');
        $qpayApi->setMchKey('8525638f86969d1de5c51ad0494f4f13');
        $qpayApi->setIsSSL(true);
        $qpayApi->setCertFilePath('/Users/aji/documents/Project/sicmouse-api/app/apiclient_cert.pem');
        $qpayApi->setKeyFilePath('/Users/aji/documents/Project/sicmouse-api/app/apiclient_key.pem');
        $ret = $qpayApi->reqQpay($params);
        return QpayMchUtil::xmlToArray($ret);
    }

}
