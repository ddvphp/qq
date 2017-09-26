<?php
namespace DdvPhp\QQ;

class Exception extends \DdvPhp\DdvException\Error
{
  // 魔术方法
  public function __construct( $message = 'QQ Error', $code = '400', $errorId = 'QQ_ERROR' , $errorData = array() )
  {
    parent::__construct( $message , $errorId , $code, $errorData );
  }
}
