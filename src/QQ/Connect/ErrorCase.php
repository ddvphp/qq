<?php
namespace DdvPhp\QQ\Connect;
/* PHP SDK
 * @version 2.0.0
 * @author connect@qq.com
 * @copyright © 2013, Tencent Corporation. All rights reserved.
 */

/*
 * @brief ErrorCase类，封闭异常
 * */
class ErrorCase{
    private $errorMsg;

    public function __construct(){
        $this->errorMsg = array(
            "20001" => "<h2>配置文件损坏或无法读取，请重新执行intall</h2>",
            "50001" => "<h2>可能是服务器无法请求https协议</h2>可能未开启curl支持,请尝试开启curl支持，重启web服务器，如果问题仍未解决，请联系我们"
            );
    }

    /**
     * showError
     * 显示错误信息
     * @param int $code    错误代码
     * @param string $description 描述信息（可选）
     */
    public function showError($code, $description = '$'){
        $description = $description == "$" && isset($this->errorMsg[$code]) ? $this->errorMsg[$code] : $description;
        throw new Exception($description, $code);
    }
    public function showTips($code, $description = '$'){
    }
}
