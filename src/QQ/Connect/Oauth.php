<?php
namespace DdvPhp\QQ\Connect;
/* PHP SDK
 * @version 2.0.0
 * @author connect@qq.com
 * @copyright © 2013, Tencent Corporation. All rights reserved.
 */

class Oauth{

    const VERSION = "2.0";
    const GET_AUTH_CODE_URL = "https://graph.qq.com/oauth2.0/authorize";
    const GET_ACCESS_TOKEN_URL = "https://graph.qq.com/oauth2.0/token";
    const GET_OPENID_URL = "https://graph.qq.com/oauth2.0/me";
    
    public $urlUtils;
    protected $error;
    // ====
    protected $appid;
    protected $callback;
    protected $scope;
    protected $appkey;
    protected $access_token;
    protected $openid;
    

    function __construct(){
        $this->urlUtils = new URL();
        $this->error = new ErrorCase();
    }

    public function setAppId($appid){
        $this->appid = $appid;
    }
    public function setAppKey($appkey){
        $this->appkey = $appkey;
    }
    public function setScope($scope){
        $this->scope = $scope;
    }
    public function setOpenid($openid){
        $this->openid = $openid;
    }
    public function setAccessToken($access_token){
        $this->access_token = $access_token;
    }
    public function setCallbackUrl($callback){
        $this->callback = $callback;
    }
    public function qq_login($scope, $callback = null, $state = '', $appid = null){
        //-------构造请求参数列表
        $keysArr = array(
            "response_type" => "code",
            "client_id" => empty($appid) ? $this->appid : $appid,
            "redirect_uri" => urlencode(empty($callback) ? $this->callback : $callback),
            "scope" => empty($scope) ? $this->scope : $scope,
            "state" => $state,
        );

        return $this->urlUtils->combineURL(self::GET_AUTH_CODE_URL, $keysArr);
    }

    public function qq_callback($callback = null, $appid = null, $appkey = null){

        //-------请求参数列表
        $keysArr = array(
            "grant_type" => "authorization_code",
            "client_id" => empty($appid) ? $this->appid : $appid,
            "redirect_uri" => urlencode(empty($callback) ? $this->callback : $callback),
            "client_secret" => empty($appkey) ? $this->appkey : $appkey,
            "code" => $_GET['code']
        );

        //------构造请求access_token的url
        $token_url = $this->urlUtils->combineURL(self::GET_ACCESS_TOKEN_URL, $keysArr);
        $response = $this->urlUtils->get_contents($token_url);

        if(strpos($response, "callback") !== false){

            $lpos = strpos($response, "(");
            $rpos = strrpos($response, ")");
            $response  = substr($response, $lpos + 1, $rpos - $lpos -1);
            $msg = json_decode($response);

            if(isset($msg->error)){
                $this->error->showError($msg->error, $msg->error_description);
            }
        }

        $params = array();
        parse_str($response, $params);

        $this->access_token = $params["access_token"];

        return $params["access_token"];

    }

    public function get_openid($access_token = null, $isOpenid = true){

        //-------请求参数列表
        $keysArr = array(
            "access_token" => empty($access_token) ? $this->access_token : $access_token
        );

        $graph_url = $this->urlUtils->combineURL(self::GET_OPENID_URL, $keysArr);
        $response = $this->urlUtils->get_contents($graph_url);

        //--------检测错误是否发生
        if(strpos($response, "callback") !== false){

            $lpos = strpos($response, "(");
            $rpos = strrpos($response, ")");
            $response = substr($response, $lpos + 1, $rpos - $lpos -1);
        }

        $user = json_decode($response);
        if(isset($user->error)){
            $this->error->showError($user->error, $user->error_description);
        }
        $this->openid = $user->openid;

        if ($isOpenid){
            return $user->openid;
        }else{
            return $user;
        }

    }
}
