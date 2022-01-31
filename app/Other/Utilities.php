<?php
namespace App\Other;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cookie;

class Utilities{

  public static $cookie_msisdn = 'sb_loginmsisdn';
  public static $cookie_pincode ='sb_loginpincode';
  public static $cookie_play = 'sb_play';
  public static $cookie_token = 'sb_token';
  public static $cookie_packcode = 'sb_packcode';
  public static $cookie_packtext = 'sb_packtext';
  public static $cookie_subscriptionid = 'sb_subscriptionid';

  public static function getMsisdn(){
    if (isset($_COOKIE[self::$cookie_msisdn])){
      return $_COOKIE[self::$cookie_msisdn];
    }
  }

  public static function getCookieValuePlay(){
    if (isset($_COOKIE[self::$cookie_play])){
      return $_COOKIE[self::$cookie_play];
    }

  }

  public static function getCookieValueToken(){

    if (isset($_COOKIE[self::$cookie_token])){
      return $_COOKIE[self::$cookie_token];
    }

  }

  public static function getCookieValuePacktext(){
    if (isset($_COOKIE[self::$cookie_packtext])){
      return $_COOKIE[self::$cookie_packtext];
    }

  }

  public static function getCookieValuePackcode(){
    if (isset($_COOKIE[self::$cookie_packcode])){
      return $_COOKIE[self::$cookie_packcode];
    }

  }

  public static function getCookieValuePincode(){
    if (isset($_COOKIE[self::$cookie_pincode])){
      return $_COOKIE[self::$cookie_pincode];
    }
  }

  public static function getSubscriptionId(){
    if (isset($_COOKIE[self::$cookie_subscriptionid])){
      return $_COOKIE[self::$cookie_subscriptionid];
    }
  }

  public static function setMsisdnCookie($msisdn_login){
    setcookie(self::$cookie_msisdn, $msisdn_login, 0, '/');
  }

  public static function setUserCookie($msisdn_login, $password_login, $play, $token, $packcode, $packtext, $subscriptionid){

    setcookie(self::$cookie_msisdn, $msisdn_login, 0, '/');
    setcookie(self::$cookie_pincode, $password_login, 0, '/');
    setcookie(self::$cookie_play, $play, 0, '/');
    setcookie(self::$cookie_token, $token, 0, '/');
    setcookie(self::$cookie_packcode, $packcode, 0, '/');
    setcookie(self::$cookie_packtext, $packtext, 0, '/');
    setcookie(self::$cookie_subscriptionid, $subscriptionid, 0, '/');
  }


  public static function setUnsetUserCookie($msisdn_login, $password_login, $play, $token, $packcode, $packtext){

    setcookie(self::$cookie_msisdn, null, -1, '/');
    setcookie(self::$cookie_pincode, null, -1, '/');
    setcookie(self::$cookie_token, null, -1, '/');

    setcookie(self::$cookie_play, $play, 0, '/');
    setcookie(self::$cookie_packcode, $packcode, 0, '/');
    setcookie(self::$cookie_packtext, $packtext, 0, '/');
  }

  public static function unsetUserCookie(){

    setcookie(self::$cookie_msisdn, null, -1, '/');
    setcookie(self::$cookie_pincode, null, -1, '/');
    setcookie(self::$cookie_token, null, -1, '/');

    setcookie(self::$cookie_play, null, -1, '/');
    setcookie(self::$cookie_packcode, null, -1, '/');
    setcookie(self::$cookie_packtext, null, -1, '/');

  }

}

?>
