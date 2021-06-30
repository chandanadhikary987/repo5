<?php
require_once 'library' . DIRECTORY_SEPARATOR . 'app.php';
use Application\Config;
use Application\Session;
use Application\Helper\Provider;
use Application\Request;
require_once 'class' . DIRECTORY_SEPARATOR . 'Http.php';
require_once 'class' . DIRECTORY_SEPARATOR . 'Functions.php';
require_once 'class' . DIRECTORY_SEPARATOR . 'allGlobalVariables.php';
require_once 'custom_db_config.php';
use Extension\Membership\Membership;
 if(Session::has('sessMemberexsit')){
 	if(Session::get('sessMemberexsit')==1){
 		$firstTimeUser=1;
 		$memberObj = new Membership();
        $memberObj ->createMember();
 	}else{
 		$firstTimeUser=0;
 		//require_once 'phpmailer' . DIRECTORY_SEPARATOR . 'PHPMailerAutoload.php';
 	}
 }

// Create User if NOT EXSIT


// @END

$cartdata = Session::get('cartSessData');
$klaviyogummies = array(
	'flag' => false,
	'event' => '',
	'product' => '',
	'page' => '',
);
$klaviyogummiesAbtest = array(
	'flag' => false,
	'event' => '',
	'product' => '',
	'page' => '',
);


$allSubscriptionProIds=allSubscriptionProductIds();

if( !empty($cartdata) && is_array($cartdata) ) {

	foreach ($cartdata as $cartitemkey => $cartitem) {
		if( array_key_exists('campaign_label', $cartitem) && preg_match('/^(?=.*CBD Gummies)(?=.*Subscription)/s', $cartitem['campaign_label']) ) {
			if( array_key_exists('pagname', $cartitem) && preg_match('/product-gummies.php/i', $cartitem['pagname']) ) {
				$klaviyogummies = array(
					'flag' => true,
					'event' => 'CBD Gummies',
					'product' => preg_replace('/step1-/i', '', $cartitem['campaign_label']),
					'page' => $cartitem['pagname'],
				);
			}
			
			
		}
	}
}



//remove Cookies
	// $cartCookieData = unserialize($_COOKIE['cartsCookiesData']);

	// if (isset($_COOKIE['cartsCookiesData'])) {
	// 	// delete cookie
 //   			 unset($_COOKIE['cartsCookiesData']);   
 //    		 setcookie('cartsCookiesData', null, -1, '/');
 //   		 // Create Cookies for cartSessData
	// 	$cookie_name = "cartsCookiesData";
	// 	$cookie_value = Session::get('cartSessData');
	// 	setcookie($cookie_name, serialize($cookie_value), time() + (86400 * 30), "/"); // 86400 = 1 day
		    
	// 	} else {
	// 	   // return false;
	// 	}

$resOutput=Provider::orderView(array(Session::get('steps.1.orderId')));
$data=[];
$data['totalAmount']=0;
if(!empty($resOutput[0]['data'][0]['couponCode'])){
 	$couponCode=$resOutput[0]['data'][0]['couponCode'];
}
else{
 	$couponCode="";
}

$discount_price = $resOutput[0]['data'][0]['discountPrice'] ? $resOutput[0]['data'][0]['discountPrice'] : 0;
$totalOrderValue = $resOutput[0]['data'][0]['totalAmount'] ? $resOutput[0]['data'][0]['totalAmount'] : 0;

$totalAmountWithTax=0;
if(!empty($resOutput)){
	$data=$resOutput[0]['data'][0];	
	$fulfillment=$data['fulfillments'][0]['items'];
	foreach($resOutput[0]['data'] as $key =>$val){
	$data=$resOutput[0]['data'][$key];
	$dataItem=$resOutput[0]['data'][$key]['items'];
	$dataKey=$key;
	}
	

	// $CompanyOrderItems = array();
	$impactPixelData=array();
	$liveconnect=[];
	$indexCount=0;
	$totalPrice=0;
	foreach($data['items'] as $key =>$val){

		$totalPrice+=$val['price'];
		$liveconnectTag='{ "id": '.$val['productId'].', "price": '.$val['price'].', "quantity": 1, "currency": '."USD".' }';
		// if(!in_array($val['productId'],array(48,49,54,55,60,61,66,67,72,73))){
		//  if( strpos ($data['items'][$key]['name'], "Gummies") !== false ){
			
		// 	$str = '{ "Category": 12, "EntityCode": encodeURIComponent("https://sundayscaries.com/cbd-gummies"), "EntityName": encodeURIComponent("CBD Gummies"), "EntityUrl": encodeURIComponent("https://sundayscaries.com/cbd-gummies#reviews") }';
		// } 
		//  if( strpos ($data['items'][$key]['name'], "Vegan") !== false ){
			
		// 	$str = '{ "Category": 12, "EntityCode": encodeURIComponent("https://sundayscaries.com/vegan-cbd-gummies"), "EntityName": encodeURIComponent("Vegan AF"), "EntityUrl": encodeURIComponent("https://sundayscaries.com/vegan-cbd-gummies#reviews") }';
		// } 
		//  if( strpos ($data['items'][$key]['name'], "Tincture") !== false ){
		// 	$str = '{ "Category": 12, "EntityCode": encodeURIComponent("https://sundayscaries.com/cbd-tincture"), "EntityName": encodeURIComponent("CBD Tincture"), "EntityUrl": encodeURIComponent("https://sundayscaries.com/cbd-tincture#reviews") }';
		// }
		// if( strpos ($data['items'][$key]['name'], "Unicorn") !== false ){
		// 	$str = '{ "Category": 12, "EntityCode": encodeURIComponent("https://sundayscaries.com/cbd-candy/"), "EntityName": encodeURIComponent("Unicorn Jerky"), "EntityUrl": encodeURIComponent("https://sundayscaries.com/cbd-candy/#reviews") }';
		// }
		

		// if( strpos ($data['items'][$key]['name'], "Tub Cub") !== false ){
		// 	$str = '{ "Category": 12, "EntityCode": encodeURIComponent("https://sundayscaries.com/cbd-bath-bombs/"), "EntityName": encodeURIComponent("Tub Cub"), "EntityUrl": encodeURIComponent("https://sundayscaries.com/cbd-bath-bombs/#reviews") }';
		// }

		// array_push($CompanyOrderItems, $str);
	
  //      }
	
	array_push($liveconnect, $liveconnectTag);
	}
	$liveconnect='['.implode(',', $liveconnect).']';
	// $CompanyOrderItems=array_unique($CompanyOrderItems);
	// Create Data for Impact Radius Pixel
	$sub_product_revenue='';
	$subscriptProPresent=[];
    // Data for Rev Offers 11/19/2019
    $productQuantity = array();
    // Data for new CannaVu Pixel 9/5/2019
    $productSKUs = array();
    $baseProductPrices = array();
    $discountedProductPrices = array();
    $csvProductSKUs = array();
    $cartQuantity = 0;
	foreach($data['items'] as $key =>$valData){
		 if(in_array($valData['productId'],$allSubscriptionProIds)){
		 	$perPrice=$valData['price'];
		 	$sub_product_revenue+=$perPrice;
		 	$subscriptProPresent[]=1;	

		 }
         
        // for CannaVu
        $cartQuantity += $valData['qty'];        
		$eachprice=$valData['price']/$valData['qty'];        
		$totalPrice=$totalPrice;
		$percentDiscount=($discount_price/$totalPrice)*100;
		$percenSaletax=($resOutput[0]['data'][0]['salesTax']/$totalPrice)*100;
		$price=$valData['price'];
		 $discountForeach=($price*$percentDiscount)/100;
		 $addTax=($price*$percenSaletax)/100;
		 $addTax=$addTax?$addTax:'0.00';
		 $subTotal=number_format($price,2)-$discountForeach+$addTax;
		 $subTotalNew=number_format($price,2)+$addTax;
        
        // for CannaVu
        $discountedProductPrice = $discountForeach * $valData['qty'];
        

	
          $pixelStr='{'."subTotal:".'"'.number_format($subTotal,2).'"'.",category:".'"'."Sunday Scaries".'"'.",sku:".'"'.$fulfillment[$indexCount]['sku'].'"'.",quantity:".$valData['qty'].'}';
		array_push($impactPixelData, $pixelStr);
        // data for Rev Offers pixel
	array_push($productQuantity, $valData['qty']);
        // data for new CannaVu Pixel
        array_push($productSKUs, $fulfillment[$indexCount]['sku']);
        array_push($baseProductPrices, number_format($price, 2));
        array_push($discountedProductPrices, number_format($price - $discountForeach, 2));
        
        // data for source knowledge pixel
        array_push($csvProductSKUs, $fulfillment[$indexCount]['sku']);
		$indexCount++;
	}
    //impact radius Pixal Final array
	$impactPixelDatas = '['.implode(',', $impactPixelData).']';

     // echo "<pre>";
     // print_r($impactPixelData);
     // echo "</pre>";
     // die;

    // data for Rev Offers pixel
    $productQuantity = "[".implode(",", $productQuantity)."]";
    // data for new CannaVu Pixel
    $sumBaseProductPrices = number_format(array_sum($baseProductPrices), 2);
    $productSKUs = "['".implode("','", $productSKUs)."']";
    $baseProductPrices = "['".implode("','", $baseProductPrices)."']";
    $discountedProductPrices = "['".implode("','", $discountedProductPrices)."']";
    $csvProductSKUs = implode(',', $csvProductSKUs);

	$items=implode('<br>', array_column($data['items'], 'name'));
	$commaitems=implode(',', array_column($data['items'], 'name'));
	$itemsIds=implode(',', array_column($data['items'], 'productId'));

	//  if(!empty($CompanyOrderItems)){
	//  $CompanyOrderItem = '['.implode(',', $CompanyOrderItems).']';	
	// }else{
	// 	$CompanyOrderItem='';
	// }

	

}


$affId = !empty($_GET['affId']) ? $_GET['affId'] : '';
$c1 = !empty($_GET['c1']) ? $_GET['c1'] : '';
$order_id = !empty($_GET['order_id']) ? $_GET['order_id'] : '';

if( ($_COOKIE['cbdaff_pixel'] !== $order_id) && $affId == 'A9F251D4' && $c1 == '[CBDAFF]' ){
	setcookie('cbdaff_pixel', $order_id, time() + (86400 * 30), "/");
}

if( $_COOKIE['aff_pixel'] !== $order_id ){
	setcookie('aff_pixel', $order_id, time() + (86400 * 30), "/");
}





Session::set('extensions.konnektiveUtilPack.importClick',array());



 Session::set('cartSessData',array());


//=============================================================================================//
 // create referal Link and insert
 // if($firstTimeUser){

 // Create New ReferCode 
   $referalCode=randomPassword();
   $checkReferCode=checkReferrelCodeExsit('tbl_referrals',$referalCode);
   if(!$checkReferCode){
   $referralData['referrer_id']=$data['customerId'];
   $referralData['referrer_email']=$data['emailAddress'];
   $referralData['referrer_code']=$referalCode;
   $checkReferalEmail=checkRreferrerEmail($referralData['referrer_email'],'tbl_referrals',''); 
       // if user dont have referal code create a new uniquie
   if(!$checkReferalEmail->num_rows){
	 insertData('tbl_referrals',$referralData);
	 }


	 // if user Have referrel code in cookies
	 if(!empty(unserialize($_COOKIE['rferkidCookies']))){
	 	$referrer_code=unserialize($_COOKIE['rferkidCookies']);
	 	$referred_email=$data['emailAddress'];
	 	// check referal code is valid or not.
	 	$checkValidRefercode=checkReferrelCodeExsit('tbl_referrals',$referrer_code);
	 	$checkUserEmail=checkUserEmail('tbl_referrals',$referred_email,$referrer_code);

	 	if(!$checkUserEmail){
	 		if($checkValidRefercode){
	 			$user_referrer_email = getReferralEmail($referrer_code, 'tbl_referrals')['referrer_email'];

	 		    //check  refered code exsit or not
	 		$checReference=checkReferece('tbl_reference',$referred_email,$referrer_code);
	 		
	 		if($checReference->num_rows){
	 				// if row exsit then check status
	 			     $checkRefereceStatus=checkRefereceStatus('tbl_reference',$referred_email,$referrer_code);
	 			     if($checkRefereceStatus->num_rows){
	 			     	// update reference status and refer rank
	 			     	updateReferenceStatus('tbl_reference',$referred_email,$referrer_code,$order_id);
					 	updateRankForReferUser('tbl_referrals',$referrer_code);
					 	//sendEmailToReferrer($user_referrer_email);
	 			     }

					 		
	 			}else
	 			{
			 		// insert row into reference Table
			 		$referenceData['referrer_code']=$referrer_code;
		            $referenceData['referred_email']=$referred_email;
		            $referenceData['orderId']=$order_id;
		            $insertNewRow=InsertData('tbl_reference',$referenceData);
		             if($insertNewRow){
		             	 // update reference status and refer rank
		             	updateReferenceStatus('tbl_reference',$referred_email,$referrer_code,$order_id);
						updateRankForReferUser('tbl_referrals',$referrer_code);
						//sendEmailToReferrer($user_referrer_email);
		             }

	 	}	
	 	}

	 	}
	 	else{
	 		
	 	}

	 	
	 	
	 	
	 }else{
	 	$checkWithReference=checkWithReferanceTable($data['emailAddress'],'tbl_reference',''); 
	 
	 	
	 	if(!empty($checkWithReference)){
	 	updateReferenceStatus('tbl_reference',$data['emailAddress'],$checkWithReference['referrer_code'],$order_id);
		updateRankForReferUser('tbl_referrals',$checkWithReference['referrer_code']);
		

	 	}
	 }

   }
 
 // }
   //=========================================================================================//
App::run(array(
    //'step'      => 3,
    'version'   => 'desktop',
    'tpl'       => 'thank-you.tpl',
    'go_to'     => '',
    'tpl_vars'  => array('productQuantity'=>$productQuantity, 'csvProductSKUs'=>$csvProductSKUs, 'cartQuantity'=>$cartQuantity, 'sumBaseProductPrices'=>$sumBaseProductPrices, 'productSKUs'=>$productSKUs, 'baseProductPrices'=>$baseProductPrices, 'discountedProductPrices'=>$discountedProductPrices, 'totalAmount'=>$data['totalAmount'],'items'=>$items,'couponCode'=>$couponCode,'dataitems'=>$data['items'],'impactPixelData'=>$impactPixelDatas,'allDta'=>$resOutput, 'discountPrice'=>number_format($discount_price,2), 'totalOrderValue'=>$totalOrderValue,'salesTaxValue'=>$data['salesTax'],'customerEmail'=>$customerEmail,'shippingValue'=>$resOutput[0]['data'][0]['shipUpcharge'],'subscriptPresent'=>$subscriptProPresent,'commaitems'=>$commaitems, 'doLoadScripts'=>$doLoadScripts,'klaviyogummies'=>$klaviyogummies,'klaviyogummiesAbtest'=>$klaviyogummiesAbtest,'firstTimeUser'=>$firstTimeUser,'itemsIds'=>$itemsIds,'liveConnectArray'=>$liveconnect,'hasTaxJarOrder'=>$hasTaxJarOrder,'sub_product_revenue'=>$sub_product_revenue),
    'pageType'  => 'thankyouPage',
));