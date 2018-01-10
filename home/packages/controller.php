<?php 
class Controller {
      
  private static $_controller;
  private function __construct() {
  }

  public static function getInstance() {
    global $_controller;
    if (!isset($_controller)) {
      $_controller = new Controller();
    }
    return $_controller;
  }

  function isMobileDevice(){
    $aMobileUA = array(
      '/iphone/i'             =>  'iPhone',
      '/ipod/i'               =>  'iPod',
      '/ipad/i'               =>  'iPad',
      '/android/i'            =>  'Android',
      '/blackberry/i'         =>  'BlackBerry',
      '/webos/i'              =>  'Mobile'
    );

    //Return true if Mobile User Agent is detected
    foreach($aMobileUA as $sMobileKey => $sMobileOS){
      if(preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT'])){
        return true;
      }
    }
    //Otherwise return false..  
    return false;
  }
  /*
  *	Mobile device detection
  */
  function mobile_user_agent_switch(){
    $deviceText = '?body=';

    if(stristr($_SERVER['HTTP_USER_AGENT'],'ipad') || stristr($_SERVER['HTTP_USER_AGENT'],'iphone') || strstr($_SERVER['HTTP_USER_AGENT'],'iphone')) {
      $deviceText = "&body=";
    } else {
      $deviceText = "?body=";
    }
    return $deviceText."DONAR"; 
  }
}

?>