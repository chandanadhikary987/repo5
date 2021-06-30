<?php
require_once 'library' . DIRECTORY_SEPARATOR . 'app.php';
require_once 'class' . DIRECTORY_SEPARATOR . 'Functions.php';
use Application\Config;
use Application\Session;
use Application\Request;
$campaigns=Config::campaigns();
require_once 'LoadFreeOptimizer.php';
$LoadFreeOptimizer = new LoadFreeOptimizer();
$doLoadScripts = $LoadFreeOptimizer->init();
// Campaign ids for Gummies
$campaignIds=['1','2','3','4','5','6'];

// Create for CBD Gummies
$gummiesCampaign = [];
foreach($campaigns as $key => $value)
{


if(in_array($value['id'], $campaignIds)){
  
        
        $gummiesCampaign[$key] = $value;
}
 
}



// Create cookies for affilate Data

  handleAffiliateCookieData('/cbd-gummies/');

//End

Session::set('queryParams', Request::query()->all());
$affiliatesMapping = array(
  'afId'    => array('AFID', 'afid'),
  'affId'   => array('AFFID', 'affid'),
  'sId'     => array('SID', 'sid'),
  'c1'      => array('C1'),
  'c2'      => array('C2'),
  'c3'      => array('C3'),
  'c4'      => array('C4'),
  'c5'      => array('C5'),
  'aId'     => array('AID', 'aid'),
  'opt'     => array('OPT', 'opt'),
  'clickId' => array('click_id'),
);
$queryKeys  = array_keys(Request::query()->all());
$affiliates = array();
foreach (array_keys($affiliatesMapping) as $key) {
  if (in_array($key, $queryKeys)) {
    $affiliates[$key] = Request::query()->get($key);
    continue;
  }
  foreach ($affiliatesMapping[$key] as $alias) {
    if (in_array($alias, $queryKeys)) {
      $affiliates[$key] = Request::query()->get($alias);
      break;
    }
  }
}
Session::set('affiliates', $affiliates);
setcookie("gatrackedNew", "", time() - 3600,'/');
//End
// echo "<pre>";
// print_r($gummiesCampaign);
// echo "</pre>";

App::run(array(
    'config_id' => 1,
    'step'      => 1,
    'tpl'       => 'product-gummies.tpl',
    'go_to'     => 'thank-you.php',
    'version'   => 'desktop',
    'tpl_vars'  => array(
    	'gummiesOffers'=>$gummiesCampaign,'doLoadScripts' => $doLoadScripts
    ),
    'pageType'  => 'checkoutPage',
));
