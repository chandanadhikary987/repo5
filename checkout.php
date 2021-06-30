<?php
require_once 'library' . DIRECTORY_SEPARATOR . 'app.php';
require_once 'class' . DIRECTORY_SEPARATOR . 'allGlobalVariables.php';
require_once 'LoadFreeOptimizer.php';
require_once 'custom_db_config.php';

use Application\Config;
use Application\Session;

$allCampaigns=Config::campaigns();
$campaignProductIds = [];

foreach ($allCampaigns as $key => $value) {
  $campaignProductIds[$key] = $value['product_id'];
}

$mainProductPrice=mainProductPrice();
$subscriptionProductPrice=subscriptionCampaignPrice();
$productSKUs = array();
$allSubscriptionProIds=allSubscriptionProductIds();
$subscriptProPresent=[];
$subTotal=0;
if(!empty(Session::get('cartSessData'))){
  $camIds=[];
 
 foreach(Session::get('cartSessData')as $val){

  if(!empty($val['product_id'])){
 // Create Product SKU
  array_push($productSKUs, productSku($val['product_id']));
  //create Subscription Arry if any
  if(in_array($val['product_id'],$allSubscriptionProIds)){
           $subscriptProPresent[]=1;
            $val['productType']='Subscription';
        }else{
          $val['productType']='onetime';
        }
// Create SubTotal
        $subTotal+=($val['product_price']*1);
   // Create Cart array     
   $cartArray[] = $val;
   array_push($camIds, $val['id']);
}
  
}

}

$subscriptPresent=$subscriptProPresent;

if(!empty($subscriptPresent)){
  $subscriptExsit=1;
}else{
   $subscriptExsit=0; 
}



$LoadFreeOptimizer = new LoadFreeOptimizer();
$doLoadScripts = $LoadFreeOptimizer->init();


$csvProductSKUs = implode(',', $productSKUs);
$productSKUs = "['".implode("','", $productSKUs)."']";

 Session::set('skipMember',true);
if (Session::has('memberSessionData.member_token')){
  if(empty($_GET['email'])){
    $userData['email']=Session::get('memberSessionData.email');
  }else{
    $userData['email']=$_GET['email'];
  }
   $userData=memberDetails(trim($userData['email']),trim('membership'));
   $user_info=json_decode($userData['user_info'],TRUE);
 if(!empty($user_info)){
     Session::set('memberSessionData.firstName',$user_info['user_info']['firstName']);
     Session::set('memberSessionData.lastName',$user_info['user_info']['lastName']);
     Session::set('memberSessionData.phone',$user_info['user_info']['phone']);
   }

}else{
  $userData=[];
  $user_info=[];
}









$queryParams = Session::get('queryParams');
$quizCoupon=Session::get('quizAnswer');
$allSessionData=Session::all();

$appliedCoupon = '';
if(!empty($_GET['coupon'])){
  $appliedCoupon = $_GET['coupon'];
}else if(!empty($queryParams['coupon'])){
  $appliedCoupon = $queryParams['coupon'];  
}
else if(!empty($quizCoupon['coupon'])){
  $appliedCoupon = $quizCoupon['coupon'];  
  
}


if(count($cartArray)){
}else{

  ?>
<script>
    window.location.replace("<?= DOMAIN ?>");
</script>
<?php
 }
// echo "<pre>";
// print_r($user_info);
// echo "</pre>";
 //offer for Black Friday Version - Thursday, 11/26 to Sunday, 11/29
//Cyber Monday Version - Monday, 11/30
// if(!empty($subscriptExsit)){
// $appliedCoupon = "CYBERMONDAY";
// }else{
// $appliedCoupon = "CYBERMONDAY25";
// }

 $subscriptionId = oneTimeToSubscription();

 $allPageNames = array_map(function($val) {
  return $val['pagname'];
}, $cartArray);

App::run(array(
    'config_id' => 1,
    'step'      => 1,
    'tpl'       => 'checkout.tpl',
    'go_to'     => 'thank-you.php',
    'version'   => 'desktop',
    'tpl_vars'  => array('doLoadScripts'=>$doLoadScripts,'subTotal'=>$subTotal,'productSKUs'=>$productSKUs,'appliedCoupon'=>$appliedCoupon,'mainProductPrice'=>$mainProductPrice,'subscriptionProductPrice'=>$subscriptionProductPrice,'cartArray'=>$cartArray,'allPageNames'=>$allPageNames,'allSessionData'=>$allSessionData,'queryParams'=>$queryParams,'userData'=>$userData,'addonarry'=>$addonarry,'user_info'=>$user_info,'camIds'=>$camIds,'quizCoupon'=>$quizCoupon,'csvProductSKUs'=>$csvProductSKUs,'subscriptPresent'=>$subscriptExsit,'subscriptionId'=>$subscriptionId, 'campaignProductIds'=>$campaignProductIds),
    'pageType'  => 'checkoutPage',
));
