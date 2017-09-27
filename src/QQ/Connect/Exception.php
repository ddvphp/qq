<?php
namespace DdvPhp\QQ\Connect;

class Exception extends \DdvPhp\QQ\Exception
{
  // 魔术方法
  public function __construct( $message = 'QQ Error', $code = '400', $errorId = 'QQ_ERROR' , $errorData = array() )
  {
    parent::__construct( $message, $code, $errorId, $errorData );
  }
}
