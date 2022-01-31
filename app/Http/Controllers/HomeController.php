<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Model\MainModel;
use App\Other\Utilities;
use Redirect;
use Alert;
use Session;

class HomeController extends Controller {

  private $mainModel;

  public function __construct(){
    $this->mainModel = new MainModel();
  }
  public function error(){
     echo "<div style='text-align:center; padding:20%; font-size: 20px; '>Sceneabox is under maintanance, try later.</div>";

  }

  public function index(Request $request){




    $useragent=$_SERVER['HTTP_USER_AGENT'];

    if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){

      $browserDevice = 1;
    }else{
      $browserDevice = 0;
    }

    Session::put('brsDevice',$browserDevice);

   

    $cookie_value_msisdn = HomeController::getHeaderMsisdn();
    $cookie_value_pincode = Utilities::getCookieValuePincode();

    HomeController::refreshCookieByMsisdn($cookie_value_msisdn,$cookie_value_pincode);
    $cookie_value_play = Utilities::getCookieValuePlay();
    $jsonData = $this->mainModel->homeData($cookie_value_msisdn,'home','home');



    return view('pages.index')->with(["cookie_value_msisdn" => $cookie_value_msisdn,
                                      "cookie_value_play" => $cookie_value_play,
                                      "browsdata" => $browserDevice,
                                      "data" => json_decode($jsonData)],);
  }

  public function search(Request $request){
    $key = $request->request->get('key');
    $page = $request->request->get('page');
    $cookie_value_msisdn = HomeController::getHeaderMsisdn();
    $cookie_value_play = Utilities::getCookieValuePlay();

    if ($page!="") {
      $json = $this->mainModel->getSearch($cookie_value_msisdn, $key, $page);
      $data = json_decode($json);
      return view('pages.moredata')->with(['data'=>$data,
                                           'cookie_value_msisdn'=>$cookie_value_msisdn,
                                           'cookie_value_play' => $cookie_value_play,
                                           'key'=>$key]);
    }else{
      $json = $this->mainModel->getSearch($cookie_value_msisdn, $key, "1");
      $data = json_decode($json);
      return view('pages.search')->with(['data'=>$data,
                                          'cookie_value_msisdn'=>$cookie_value_msisdn,
                                          'cookie_value_play' => $cookie_value_play,
                                          'key'=>$key]);
    }
  }


  public function category(Request $request, $category){
      $cookie_value_msisdn = HomeController::getHeaderMsisdn();
      $cookie_value_play = Utilities::getCookieValuePlay();
      if($category=='tvshow'){
        $jsonData = $this->mainModel->homeData($cookie_value_msisdn,"category",'tvs');
      }else if($category=='drama'){
        $jsonData = $this->mainModel->homeData($cookie_value_msisdn,"category",'drm');
      }else if($category=='comedy'){
        $jsonData = $this->mainModel->homeData($cookie_value_msisdn,"category",'com');
      }else if($category=='music'){
        $jsonData = $this->mainModel->homeData($cookie_value_msisdn,"category",'msc');
      }else if($category=='healtheducation'){
        $jsonData = $this->mainModel->homeData($cookie_value_msisdn,"category",'hle');
      }else if($category=='movie'){
        $jsonData= $this->mainModel->homeData($cookie_value_msisdn,"category",'mov');
      }
      return view('pages.index')->with(["cookie_value_msisdn" => $cookie_value_msisdn,
                                        "cookie_value_play" => $cookie_value_play,
                                        "data" => json_decode($jsonData)]);
    }


  public function seeallfrontend($seeTitle ,$key){
     $title1 = ucwords(str_replace('-', ' ', $seeTitle));
     $tcData = explode("-",$key);
     $ct = $tcData[0];



     $tc = $tcData[1];
     $title = $title1;
     $resolution = 0;
     $cookie_value_msisdn = HomeController::getHeaderMsisdn();
     $cookie_value_play = Utilities::getCookieValuePlay();

     if($ct == "cwt"){
      $jsonData = $this->mainModel->contineWatchingData($ct, $tc);
      echo "somegthing";die;
     }else{
       $jsonData = $this->mainModel->seeall("1", $ct, $tc, $title, 0);
     }

      return view('pages.seeall')->with(["cookie_value_msisdn" => $cookie_value_msisdn,
                                        "cookie_value_play" => $cookie_value_play,
                                        "ct" => $ct,
                                        "tc" => $tc,
                                        "title" => $title,
                                        "resolution" => $resolution,
                                        "data" => json_decode($jsonData)]);

  }

public function seeall(Request $request ){
    $ct = $request->request->get('ct');
    $tc = $request->request->get('tc');
    $title = $request->request->get('title');
    $resolution = $request->request->get('resolution');
    $page = $request->request->get('page');
    $cookie_value_msisdn = HomeController::getHeaderMsisdn();
    $cookie_value_play = Utilities::getCookieValuePlay();


    /*$dashtitle = str_replace(' ', '-', $title);
    $urlLink = strtolower($dashtitle);
    $posturl =  url()->current()."/".$urlLink .'/'.$ct."-".$tc;*/

    if ($page!="") {
      $jsonData = $this->mainModel->seeall($page, $ct, $tc, $title, $resolution);
      return view('pages.moredata')->with(["cookie_value_msisdn" => $cookie_value_msisdn,
                                        "cookie_value_play" => $cookie_value_play,
                                        "ct" => $ct,
                                        "tc" => $tc,
                                        "title" => $title,
                                        "resolution" => $resolution,
                                        "data" => json_decode($jsonData)]);
    }else{
      $jsonData = $this->mainModel->seeall("1", $ct, $tc, $title, $resolution);
      dd(json_decode($jsonData));
      return view('pages.seeall')->with(["cookie_value_msisdn" => $cookie_value_msisdn,
                                        "cookie_value_play" => $cookie_value_play,
                                        "ct" => $ct,
                                        "tc" => $tc,
                                        "title" => $title,
                                        "resolution" => $resolution,
                                        "data" => json_decode($jsonData)]);
    }
  }

  public function login(Request $request){
    $cookie_value_msisdn = HomeController::getHeaderMsisdn();
    return view('pages.login')->with(['msg'=>"","cookie_value_msisdn" => $cookie_value_msisdn]);
  }

  public function mainlogin(Request $request){

    $cookie_value_msisdn = HomeController::getHeaderMsisdn();
    return view('pages.login')->with(['msg'=>"","cookie_value_msisdn" => $cookie_value_msisdn]);
  }

  public function signupSubmit(Request $request){

    $msisdn_login = '88'.$request->request->get('msisdn-signup');

    $json = $this->mainModel->signupSubmit($msisdn_login);
    $obj = json_decode($json);
    $msg = $obj->{'message'};

    $cookie_value_msisdn = HomeController::getHeaderMsisdn();
    return view('pages.login')->with(['msg'=>$msg,'cookie_value_msisdn'=>$cookie_value_msisdn]);
  }


  public function loginSubmit(Request $request){
    $msisdn_login = "88".$request->request->get('msisdn-login');
    $password_login = $request->request->get('password-login');
    $json = $this->mainModel->requestForLogin($msisdn_login, $password_login, "no");
    $obj = json_decode($json);
      $result=$obj[0]->result;
      $play=$obj[0]->play;
      $token = $obj[0]->token;
      $packcode = $obj[0]->packcode;
      $packtext = $obj[0]->packtext;
      if(isset($obj[0]->subscriptionid)) {
        $subscriptionid = $obj[0]->subscriptionid;
      }else{
         $subscriptionid = '';
      } 
    if($result == "success"){
      Utilities::setUserCookie($msisdn_login, $password_login, $play, $token, $packcode, $packtext, $subscriptionid);
      return Redirect::route('home');
    } else{
      $msg = "Incorrect mobile number or password. Please try again.";
      Utilities::setUnsetUserCookie($msisdn_login, $password_login, $play, $token, $packcode, $packtext);
      return view('pages.login')->with(['msg'=>$msg,'cookie_value_msisdn'=>'']);
    }
  }

  public function logout(Request $request){
    Utilities::unsetUserCookie();
    return redirect('/');
  }

  public function forgotPass(Request $request){
    $msisdn_login = '88'.$request->request->get('msisdn-forgot');
    $json = $this->mainModel->forgotPass($msisdn_login);
    $obj = json_decode($json);
    $msg = $obj->{'message'};
    $cookie_value_msisdn = Utilities::getMsisdn($request);
    return view('pages.login')->with(['msg'=>$msg,'cookie_value_msisdn'=>$cookie_value_msisdn]);
  }

  public function play(Request $request, $contentId){
    HomeController::refreshCookieByMakemylogin();
    $cookie_value_msisdn = HomeController::getHeaderMsisdn();
    $cookie_value_play= Utilities::getCookieValuePlay();
    $cookie_value_token= Utilities::getCookieValueToken();
    $videoDetailsJson = $this->mainModel->get_playcontent($cookie_value_msisdn, $contentId, "1");
    $data = json_decode($videoDetailsJson);
    $viewportMeta  = "This is viewport meta tag for contentDetails Page";

     Session::put('img-location',  $data[0]->image_location);
     Session::put('name',  $data[0]->name);
     Session::put('url',  $data[0]->url);
     Session::put('description',  $data[0]->info);

    $similar =  $this->mainModel->get_similarcontent($data[0]->catcode,"1");

   

    return view('pages.contentDetails')->with(['cookie_value_msisdn'=>$cookie_value_msisdn,
                                                'cookie_value_play'=>$cookie_value_play,
                                                'cookie_value_token'=>$cookie_value_token,
                                                'data'=>$data,
                                                'conMeta'=>$viewportMeta ,
                                                'similar'=> json_decode($similar)]);
  }



  public function postPlayTime(Request $request){
    $type = $request->request->get('type');
    $contentid = $request->request->get('contentid');
    $time = $request->request->get('time');
    $msisdn = $request->request->get('msisdn');
    $playtime = $request->request->get('playtime');
    $json = $this->mainModel->postPlayTime($type, $contentid, $time, $msisdn, $playtime);

    dd($json);
    return $json;
  }

  public function flix_myaccount(){
    // $cookie_value_msisdn = HomeController::getHeaderMsisdn();
    // $json = $this->mainModel->flix_myaccount($cookie_value_msisdn);
    //+//return view('pages.myaccount')->with(['campaigndetails'=>$json]);
  }

  public function postCampaignData(Request $request){
    $username = $request->request->get('username');
    $contentid = $request->request->get('contentid');
    $ap = $request->request->get('ap');
    $apval = $request->request->get('apval');
    $point = $request->request->get('point');

   // echo $username.$contentid.$ap.$apval.$point;
    $json = $this->mainModel->postCampaignData($username,$contentid,$ap,$apval,$point);

    return $json;
  }



  public function subscription(Request $request){
    HomeController::refreshCookieByMakemylogin();
    $cookie_value_msisdn = HomeController::getHeaderMsisdn();
    $cookie_value_packtext = Utilities::getCookieValuePacktext();
    $cookie_value_packcode = Utilities::getCookieValuePackcode();
    $msg = Session::get('msg');

    $subInfo = $this->mainModel->getSubscriptionData($cookie_value_msisdn);

    return view('pages.subscription')->with(['cookie_value_msisdn'=>$cookie_value_msisdn,
                                             'cookie_value_packtext'=>$cookie_value_packtext,
                                             'cookie_value_packcode'=>$cookie_value_packcode,
                                             'msg'=>$msg,
                                             'subInfo'=> json_decode($subInfo)]);
  }

    public function sub(Request $request){
      $msisdn = $request->request->get('msisdn');
      $packcode = $request->request->get('packcode');
      $subrequest = $request->request->get('subrequest');
      $json = $this->mainModel->getsdpurl($msisdn,$packcode);
      return $json;
    }

    public function subcheck(Request $request){

      $aocTransID = Input::get('aocTransID');
      //$cookie_value_msisdn = HomeController::getHeaderMsisdn();
      $cookie_value_msisdn = $this->mainModel->getMsisdnByAocTransId($aocTransID);
      $json = $this->mainModel->subStatusCheck($cookie_value_msisdn,$aocTransID);
      $obj = json_decode($json);

      if($obj->status=="Success"){
        HomeController::refreshCookieByMakemylogin();
        return redirect()->route('subscription')->with('msg','You have been subscribed successfully');
      }
      return redirect()->route('subscription')->with('msg','You will get an SMS shortly. Please reply to the SMS with Y to complete subscription.');
    }

  public function unsub(){
    $cookie_value_msisdn = HomeController::getHeaderMsisdn();
    $cookie_value_pincode = Utilities::getCookieValuePincode();
    HomeController::refreshCookieByMsisdn($cookie_value_msisdn, $cookie_value_pincode);
    $subscriptionId = Utilities::getSubscriptionId();

    $json = $this->mainModel->unsub($cookie_value_msisdn, $subscriptionId);
    $data = json_decode($json);

    if($data->status=="Success"){
      HomeController::refreshCookieByMakemylogin();
      return redirect()->route('subscription')->with('msg', $data->response);
    }
    return redirect()->route('subscription')->with('msg', $data->response);
  }

  public function unsubNonSms(Request $request){
    $cookie_value_msisdn = HomeController::getHeaderMsisdn();
    $subscriptionId = Utilities::getSubscriptionId();
    $json = $this->mainModel->unsub($cookie_value_msisdn, $subscriptionId);
    return $json;
  }

  public function getAccountData(Request $request){
    $cookie_value_msisdn = HomeController::getHeaderMsisdn();
    if ($cookie_value_msisdn=="") {
      $cookie_value_msisdn = '';
    }
    $campaigndetails = $this->mainModel->flix_myaccount($cookie_value_msisdn);
    $data = $this->mainModel->getAccountData($cookie_value_msisdn);
    return view('pages.myaccount')->with(['title'=>'My Account',
                                          'cookie_value_msisdn'=>$cookie_value_msisdn,
                                          'campaigndetails'=> json_decode($campaigndetails),
                                          'data'=> json_decode($data)]);
  }


  public function about(Request $request){
    return HomeController::getInfoData('about');
  }

  public function help(Request $request){
    return HomeController::getInfoData('help');
  }

  public function privacy(Request $request){
    return HomeController::getInfoData('privacy');
  }

  public function license(Request $request){
    return HomeController::getInfoData('license');
  }


  public static function refreshCookieByMakemylogin(){
    $mainModel = new MainModel();
    $cookie_value_msisdn = HomeController::getHeaderMsisdn();
    $cookie_value_pincode = Utilities::getCookieValuePincode();
    if ($cookie_value_msisdn!="" && $cookie_value_pincode!="") {
        $json = $mainModel->requestForLogin($cookie_value_msisdn, $cookie_value_pincode, "no");
        $obj = json_decode($json);
        foreach ($obj as $key => $value) {
          $result=$value->result;
          $play=$value->play;
          $token = $value->token;
          $packcode = $value->packcode;
          $packtext = $value->packtext;
          $subscriptionid = $value->subscriptionid;
        }
        Utilities::setUserCookie($cookie_value_msisdn, $cookie_value_pincode, $play, $token, $packcode, $packtext, $subscriptionid);
    }elseif ($cookie_value_msisdn!="") {
      $json = $mainModel->requestForLogin($cookie_value_msisdn, "", "yes");
      $obj = json_decode($json);
      foreach ($obj as $key => $value) {
        $result=$value->result;
        $play=$value->play;
        $token = $value->token;
        $packcode = $value->packcode;
        $packtext = $value->packtext;
        $subscriptionid = $value->subscriptionid;
      }
      Utilities::setUserCookie($cookie_value_msisdn, $cookie_value_pincode, $play, $token, $packcode, $packtext, $subscriptionid);
    }
  }

  public static function refreshCookieByMsisdn($cookie_value_msisdn, $cookie_value_pincode){
    $mainModel = new MainModel();
    if ($cookie_value_msisdn!="" && $cookie_value_pincode!="") {
        $json = $mainModel->requestForLogin($cookie_value_msisdn, $cookie_value_pincode, "no");
        $obj = json_decode($json);
        foreach ($obj as $key => $value) {
          $result=$value->result;
          $play=$value->play;
          $token = $value->token;
          $packcode = $value->packcode;
          $packtext = $value->packtext;
          $subscriptionid = $value->subscriptionid;
        }
        Utilities::setUserCookie($cookie_value_msisdn, $cookie_value_pincode, $play, $token, $packcode, $packtext, $subscriptionid);
    }elseif ($cookie_value_msisdn!="") {
      $json = $mainModel->requestForLogin($cookie_value_msisdn, "", "yes");
      $obj = json_decode($json);
      foreach ($obj as $key => $value) {
        $result=$value->result;
        $play=$value->play;
        $token = $value->token;
        $packcode = $value->packcode;
        $packtext = $value->packtext;
        $subscriptionid = $value->subscriptionid;
      }
      Utilities::setUserCookie($cookie_value_msisdn, $cookie_value_pincode, $play, $token, $packcode, $packtext, $subscriptionid);
    }

  }

  public static function getHeaderMsisdn(){

    if(isset($_SERVER['HTTP_MSISDN'])) {
       $value_msisdn= $_SERVER["HTTP_MSISDN"];
       $checkfortelco=substr($value_msisdn, 0, 5);
       if ($checkfortelco=='88018' || $checkfortelco=='88016'){
         return $value_msisdn;
       }
     } else if(isset($_SERVER['HTTP_X_MSISDN'])) {
       $value_msisdn= $_SERVER["HTTP_X_MSISDN"];
       $checkfortelco=substr($value_msisdn, 0, 5);
       if ($checkfortelco=='88018' || $checkfortelco=='88016'){
         return $value_msisdn;
       }
     }else{
       return Utilities::getMsisdn();
     }
  }

  public static function getInfoData($tag){
    $mainModel = new MainModel();
    $cookie_value_msisdn = Utilities::getMsisdn();
    $data = $mainModel->getInfoData($cookie_value_msisdn, $tag);
    return view('pages.info')->with(['tag'=>$tag,'cookie_value_msisdn'=>$cookie_value_msisdn,'data'=>json_decode($data)]);
  }
}
