<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;

class MainModel {
  private $client;
  private $baseUrl;
  private $view;
  private $catJsonPost;
  private $videoDetails;
  private $similar;
  private $loginDetails;
  private $signup;
  private $subscription;
  private $sdp;
  private $myaccount;
  private $infoData;
  private $search;
  private $subStatus;
  private $unsub;
  private $postPlayTime;
  private $postPlayTimePreview;
  private $postCampaignData;
  private $getMsisdn;
  private $flixmyaccount;

  public function __construct(){

    $this->client = new Client();

    //$this->baseUrl = "http://banglaflix.com.bd/sceneabox/api/";
    $this->baseUrl = "https://sceneabox.com/api/";
    $this->view = $this->baseUrl.'flix_json_app_data';
    $this->catJsonPost = $this->baseUrl.'flixlist_json_app';
    $this->videoDetails = $this->baseUrl.'flixlist_json_app_single';
    $this->similar = $this->baseUrl.'flixlist_json_app_similar';
    $this->loginDetails = $this->baseUrl.'flix_makemylogingettoken';
    $this->signup = $this->baseUrl.'flix_signup';
    $this->subscription = $this->baseUrl.'flix_subschemes';
    $this->sdp = $this->baseUrl.'flix_sub_instant_sdp_mife';
    $this->subStatus = $this->baseUrl.'flix_sub_status_check_mife';
    $this->unsub = $this->baseUrl.'flix_unsub_instant_mife';
    $this->myaccount = $this->baseUrl.'flix_myaccount';
    $this->infoData = $this->baseUrl.'flix_appinfo';
    $this->search = $this->baseUrl.'flix_src_app';
    $this->postPlayTime = $this->baseUrl.'flix_postplaytime';
    $this->postPlayTimePreview = $this->baseUrl.'flix_postplaytime_preview';
    $this->postCampaignData = $this->baseUrl.'flix_post_campaign_data';
    $this->getMsisdn = $this->baseUrl.'flix_getmsisdn';
    $this->flix_myaccount = $this->baseUrl.'flix_myaccount';

  }

  function homeData($msisdn, $view, $ct){
    $r = $this->client->request('POST', $this->view, [
      'form_params' => [
        'msisdn' => $msisdn,
        'view' => $view,
        'ct' => $ct,
        "useragent" =>$_SERVER["HTTP_USER_AGENT"],
        "httphost"=>$_SERVER["HTTP_HOST"],
        "remoteaddr"=>$_SERVER["REMOTE_ADDR"],
        "remoteport"=>$_SERVER["REMOTE_PORT"]
      ]
    ]);
    return $r->getBody();
  }

  function seeall($page,$ct,$tc,$title,$resolution){
    $r = $this->client->request('POST', $this->catJsonPost, [
      'form_params' => [
        "page" => $page,
        "ct" =>$ct,
        "tc"=>$tc,
        "title"=>$title,
        "resolution"=>$resolution,
        "useragent" =>$_SERVER["HTTP_USER_AGENT"],
        "httphost"=>$_SERVER["HTTP_HOST"],
        "remoteaddr"=>$_SERVER["REMOTE_ADDR"],
        "remoteport"=>$_SERVER["REMOTE_PORT"]
      ]
    ]);

    return $r->getBody();
  }

  function get_playcontent($msisdn, $contentid, $hdstatus){

    $hd = "";

    if($hdstatus=="1"){
      $hd = "hd";
    } else {
      $hd = "";
    }

    $r = $this->client->request('POST', $this->videoDetails, [
      'form_params' => [
        "username" => $msisdn,
        "cc" => $contentid,
        "resolution" => $hd]
      ]);

      return $r->getBody();
  }

  function requestForLogin($cookie_value_msisdn,$cookie_value_pincode,$cookie_value_haspin){

    $r = $this->client->request('POST', $this->loginDetails, [
      'form_params' => [
        "username" => $cookie_value_msisdn,
        "password" => $cookie_value_pincode,
        "haspin" => $cookie_value_haspin,
        "fromsrc" => "web",
        "useragent" =>$_SERVER["HTTP_USER_AGENT"],
        "httphost"=>$_SERVER["HTTP_HOST"],
        "remoteaddr"=>$_SERVER["REMOTE_ADDR"],
        "remoteport"=>$_SERVER["REMOTE_PORT"]
      ]
    ]);

    
    return $r->getBody();
  }

  function get_similarcontent($catcode,$hdstatus){

    $r = $this->client->request('POST', $this->similar, [
      'form_params' => [
        "ct" => $catcode,
        "tc" => "0",
        "resolution" => $hdstatus]
      ]);

      return $r->getBody();

    }

    function forgotPass($cookie_value_msisdn){

      $r = $this->client->request('POST', $this->signup, [
        'form_params' => [
          "msisdn" => $cookie_value_msisdn,
          "forget" => "forget",
          "fromsrc" => "web",
          "useragent" =>$_SERVER["HTTP_USER_AGENT"],
          "httphost"=>$_SERVER["HTTP_HOST"],
          "remoteaddr"=>$_SERVER["REMOTE_ADDR"],
          "remoteport"=>$_SERVER["REMOTE_PORT"] ]
        ]);

        return $r->getBody();
      }


      function signupSubmit($cookie_value_msisdn){

        $r = $this->client->request('POST', $this->signup, [
          'form_params' => [
            "msisdn" => $cookie_value_msisdn,
            "fromsrc" => "web",
            "useragent" =>$_SERVER["HTTP_USER_AGENT"],
            "httphost"=>$_SERVER["HTTP_HOST"],
            "remoteaddr"=>$_SERVER["REMOTE_ADDR"],
            "remoteport"=>$_SERVER["REMOTE_PORT"] ]
          ]);

          return $r->getBody();

        }

        function getSubscriptionData($msisdn){

          $r = $this->client->request('POST', $this->subscription, [
            'form_params' => [
              "fromsrc" => "web",
              "msisdn" => $msisdn]
            ]);

            return $r->getBody();
          }

          function getsdpurl($sub_msisdn,$sub_pack){

            $r = $this->client->request('POST', $this->sdp, [
              'form_params' => [
                "msisdn" => $sub_msisdn,
                "d" => $sub_pack,
                "fromsrc" => "web",
                "useragent" =>$_SERVER["HTTP_USER_AGENT"],
                "httphost"=>$_SERVER["HTTP_HOST"],
                "remoteaddr"=>$_SERVER["REMOTE_ADDR"],
                "remoteport"=>$_SERVER["REMOTE_PORT"] ]
              ]);

              return $r->getBody();

            }


            function subStatusCheck($msisdn,$aocTransID){

              $r = $this->client->request('POST', $this->subStatus, [
                'form_params' => [
                  "msisdn" => $msisdn,
                  "transid" => $aocTransID,
                  "fromsrc" => "web",
                  "useragent" =>$_SERVER["HTTP_USER_AGENT"],
                  "httphost"=>$_SERVER["HTTP_HOST"],
                  "remoteaddr"=>$_SERVER["REMOTE_ADDR"],
                  "remoteport"=>$_SERVER["REMOTE_PORT"] ]
                ]);

                return $r->getBody();

              }

              function getMsisdnByAocTransId($aocTransID){

                $r = $this->client->request('POST', $this->getMsisdn, [
                'form_params' => [
                  "transid" => $aocTransID,
                  "fromsrc" => "web",
                  "useragent" =>$_SERVER["HTTP_USER_AGENT"],
                  "httphost"=>$_SERVER["HTTP_HOST"],
                  "remoteaddr"=>$_SERVER["REMOTE_ADDR"],
                  "remoteport"=>$_SERVER["REMOTE_PORT"] ]
                ]);

                return $r->getBody();

              }

              function unsub($msisdn,$unsubId){

                $r = $this->client->request('POST', $this->unsub, [
                  'form_params' => [
                    "msisdn" => $msisdn,
                    "subscriptionid" => $unsubId,
                    "fromsrc" => "web",
                    "useragent" =>$_SERVER["HTTP_USER_AGENT"],
                    "httphost"=>$_SERVER["HTTP_HOST"],
                    "remoteaddr"=>$_SERVER["REMOTE_ADDR"],
                    "remoteport"=>$_SERVER["REMOTE_PORT"] ]
                  ]);

                  return $r->getBody();

                }

  function postCampaignData($username,$contentid,$ap,$apval,$point){



    $r = $this->client->request('POST', $this->postCampaignData, [
      'form_params' => [
        "contentid" =>$contentid,
        "ap" => $ap,
        "apval" => $apval,
        "username" => $username,
        "point" => $point
        ]
      ]);

     return $r->getBody();

  }
  function getAccountData($msisdn){

    $r = $this->client->request('POST', $this->myaccount, [
      'form_params' => [
        "username" => $msisdn]
      ]);

      return $r->getBody();

    }

   function getInfoData($msisdn,$key){

    $r = $this->client->request('POST', $this->infoData, [
      'form_params' => [
        "username" => $msisdn,
        "appinfo" => $key]
      ]);

      return $r->getBody();

    }

  function postPlayTime($type,$cid,$time,$msisdn,$playtime){

    if($type == "play"){

      $r = $this->client->request('POST', $this->postPlayTime, [
        'form_params' => [

          "fromsrc" => "web",
          "useragent" => $_SERVER["HTTP_USER_AGENT"],
          "httphost" => $_SERVER["HTTP_HOST"],
          "remoteaddr" => $_SERVER["REMOTE_ADDR"],
          "remoteport" => $_SERVER["REMOTE_PORT"],
          "contentid" => $cid,
          "time" => $time,
          "username" => $msisdn,
          "playtime" => $playtime]
        ]);

        return $r->getBody();
      }else{

        $r = $this->client->request('POST', $this->postPlayTimePreview, [
          'form_params' => [

            "fromsrc" => "web",
            "useragent" => $_SERVER["HTTP_USER_AGENT"],
            "httphost" => $_SERVER["HTTP_HOST"],
            "remoteaddr" => $_SERVER["REMOTE_ADDR"],
            "remoteport" => $_SERVER["REMOTE_PORT"],
            "contentid" => $cid,
            "time" => $time,
            "username" => $msisdn,
            "playtime" => $playtime]
          ]);

          return $r->getBody();
        }

      }

  function getSearch($msisdn, $key, $page){
    $r = $this->client->request('POST', $this->search, [
      'form_params' => [
        "page" => $page,
        "msisdn" =>$msisdn,
        "s"=>$key]
      ]);

      return $r->getBody();
    }

  function flix_myaccount($username){
    $r = $this->client->request('POST', $this->flix_myaccount, [
      'form_params' => [
        "username" => $username
        ]
      ]);

    return $r->getBody();
  }

}
