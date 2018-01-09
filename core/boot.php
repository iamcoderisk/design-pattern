<?php
/**
 *Author: Prince E. Darlington
 */
session_start();
$GLOBALS['config'] =  array(
  'mysql'=>array(
    'host'=>'127.0.0.1',
    'username'=>'root',
    'password'=>'prince',
    'database'=>'codefi',
    'encoding' => 'utf8',
    'timezone' => 'UTC',
    'cacheMetadata' => true,
    'log' => false,

  ),
  'remember'=>array(
    'cookie_name'=>'hash',
    'cookie_expiry'=>604800
  ),
  'session'=>array(
    'session_name'=>'user',
    'token_name'=>'token'
  )
);

spl_autoload_register(function($class){
  require_once 'classes/'.$class.'.php';
});
require_once 'functions/sanitize.php';
if(Cookie::exists(Config::get('remember/cookie_name') && !Session::exists('session/session_name')))
{
  echo $hash = Cookie::get(Config::get('remember/cookie_name'));
  $hashCheck = DB::getInstance()->get('users_session',array('hash','=',$hash));
  if($hashCheck->count())
  {
    echo"log me in";
  }
}

else{

}
