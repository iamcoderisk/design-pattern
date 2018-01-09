<?php
class Redirect
{
  public static function to($location=null)
  {
    if($location)
    {
      if(is_string($location))
      {
        header('Location:'.$location.'.php');
        exit();
      }
    }
  }
}
