<?php
require_once 'library' . DIRECTORY_SEPARATOR . 'app.php';
use Application\Config;
use Application\Session;

if(!empty($_POST['productId'])){

	$productID=trim($_POST['productId']);
	$productDetails=Config::campaigns($productID);
	$previousSession=[];
	$cartSessData= Session::get('cartSessData');
	$cartArray = array_filter($cartSessData);

	
    if($_POST['productPageName']=='product-gummies.php'){

     if(!empty($cartArray['productId_1'])){
	 	Session::set('cartSessData.productId_1', $previousSession);
	 
	 }elseif(!empty($cartArray['productId_2'])){
	 	Session::set('cartSessData.productId_2', $previousSession);
	 
	 }elseif(!empty($cartArray['productId_3'])){
	 	Session::set('cartSessData.productId_3', $previousSession);	 
	 }
	 elseif(!empty($cartArray['productId_4'])){
	 	Session::set('cartSessData.productId_4', $previousSession);	
	 }
	 elseif(!empty($cartArray['productId_5'])){
	 	Session::set('cartSessData.productId_5', $previousSession);	
	 }
	 elseif(!empty($cartArray['productId_6'])){
	 	Session::set('cartSessData.productId_6', $previousSession);
	
	 }
	 else{
	 	//Session::set('cartSessData.productId_'.$productID, $productDetails);
	 }


    }
    //if product cbd vegan
     else if($_POST['productPageName']=='product-vegan-cbd.php'){
     if(!empty($cartArray['productId_7'])){
	 	Session::set('cartSessData.productId_7', $previousSession);	 	
	 }elseif(!empty($cartArray['productId_8'])){
	 	Session::set('cartSessData.productId_8', $previousSession);	 	
	 }elseif(!empty($cartArray['productId_9'])){
	 	Session::set('cartSessData.productId_9', $previousSession);	 
	 }
	 elseif(!empty($cartArray['productId_10'])){
	 	Session::set('cartSessData.productId_10', $previousSession);	 	
	 }
	 elseif(!empty($cartArray['productId_11'])){
	 	Session::set('cartSessData.productId_11', $previousSession);	 
	 }
	 elseif(!empty($cartArray['productId_12'])){
	 	Session::set('cartSessData.productId_12', $previousSession);	 	
	 }
	 else{
	 	//Session::set('cartSessData.productId_'.$productID, $productDetails);
	 }


    }
    // if cbd tincture
    else if($_POST['productPageName']=='product-tincture.php'){

    	  if(!empty($cartArray['productId_13'])){
	 	Session::set('cartSessData.productId_13', $previousSession);	
	 }elseif(!empty($cartArray['productId_14'])){
	 	Session::set('cartSessData.productId_14', $previousSession);
	 }elseif(!empty($cartArray['productId_15'])){
	 	Session::set('cartSessData.productId_15', $previousSession);	
	 }
	 elseif(!empty($cartArray['productId_16'])){
	 	Session::set('cartSessData.productId_16', $previousSession);	 
	 }
	 elseif(!empty($cartArray['productId_17'])){
	 	Session::set('cartSessData.productId_17', $previousSession);	 
	 }
	 elseif(!empty($cartArray['productId_18'])){
	 	Session::set('cartSessData.productId_18', $previousSession);	 
	 }
	 else{
	 	//Session::set('cartSessData.productId_'.$productID, $productDetails);
	 }

    }

     // if cbd Candy
    else if($_POST['productPageName']=='cbd-candy.php' || $_POST['productPageName']=='national-coming-out-day.php'){
    	// if candy added from checkout page
    	if(!empty($_POST['from']) && $_POST['from']=='checkout'){
    		Session::set('candyAddedFromCheckout',1);
    	}else{
    		Session::set('candyAddedFromCheckout',0);
    	}

    if(!empty($cartArray['productId_82'])){
	 	Session::set('cartSessData.productId_82', $previousSession);

	 }elseif(!empty($cartArray['productId_83'])){
	 	Session::set('cartSessData.productId_83', $previousSession);

	 	 }elseif(!empty($cartArray['productId_84'])){
	 	Session::set('cartSessData.productId_84', $previousSession);
	
	 }
	 elseif(!empty($cartArray['productId_85'])){
	 	Session::set('cartSessData.productId_85', $previousSession);
	
	 }
	 elseif(!empty($cartArray['productId_86'])){
	 	Session::set('cartSessData.productId_86', $previousSession);
	
	 }
	 elseif(!empty($cartArray['productId_87'])){
	 	Session::set('cartSessData.productId_87', $previousSession);
	 
	 }
	 elseif(!empty($cartArray['productId_98'])){
	 	Session::set('cartSessData.productId_98', $previousSession);
	 }
	 elseif(!empty($cartArray['productId_99'])){
	 	Session::set('cartSessData.productId_99', $previousSession);
	 }
	 elseif(!empty($cartArray['productId_100'])){
	 	Session::set('cartSessData.productId_100', $previousSession);
	 
	 }
	 elseif(!empty($cartArray['productId_101'])){
	 	Session::set('cartSessData.productId_101', $previousSession);
	 
	 }
	 else{
	 	//Session::set('cartSessData.productId_'.$productID, $productDetails);
	 }

    }

       // product-bundle-sidePiece.php
    else if($_POST['productPageName']=='product-bundle-sidePiece.php'){

    	  if(!empty($cartArray['productId_41'])){
	 	Session::set('cartSessData.productId_41', $previousSession);

	 }elseif(!empty($cartArray['productId_42'])){
	 	Session::set('cartSessData.productId_42', $previousSession);
	 	
	 }
	 elseif(!empty($cartArray['productId_43'])){
	 	Session::set('cartSessData.productId_43', $previousSession);
	
	 }
	 elseif(!empty($cartArray['productId_44'])){
	 	Session::set('cartSessData.productId_44', $previousSession);
	
	 }
	 elseif(!empty($cartArray['productId_45'])){
	 	Session::set('cartSessData.productId_45', $previousSession);

	 }
	 elseif(!empty($cartArray['productId_46'])){
	 	Session::set('cartSessData.productId_46', $previousSession);

	 } 
	
	 else{
	 	//Session::set('cartSessData.productId_'.$productID, $productDetails);
	 }
    }
  


     // Rando Final
      if($_POST['productPageName']=='rando-bundle.php'){
     	if(!empty($cartArray['productId_74'])){
	 	Session::set('cartSessData.productId_74', $previousSession);
	 
	 	
	 }
	 elseif(!empty($cartArray['productId_75'])){
	 	Session::set('cartSessData.productId_75', $previousSession);
	
	 }else{

	 }

     }

     if($_POST['productPageName']=='cuddle-bundle.php'){
     	if(!empty($cartArray['productId_115'])){
	 		Session::set('cartSessData.productId_115', $previousSession);	
		} else{
		}
     }

       // everyday Scaries
      if($_POST['productPageName']=='everyday-scaries.php'){
     	if(!empty($cartArray['productId_94'])){
	 	Session::set('cartSessData.productId_94', $previousSession);
	 
	 	
	 }
	 elseif(!empty($cartArray['productId_95'])){
	 	Session::set('cartSessData.productId_95', $previousSession);
	
	 }else{

	 }

     }







    // if partypack-trop.php
 if($_POST['productPageName']=='partypack-trop.php'){

     if(!empty($cartArray['productId_88'])){
	 	Session::set('cartSessData.productId_88', $previousSession);

	 }if(!empty($cartArray['productId_89'])){
	 	Session::set('cartSessData.productId_89', $previousSession);

	 }
	 else{
	 	//Session::set('cartSessData.productId_'.$productID, $productDetails);
	 }


    }


   if($_POST['productPageName']=='holiday-scaries.php'){
     	if(!empty($cartArray['productId_107'])){
	 	Session::set('cartSessData.productId_107', $previousSession);	 
	 	
	 }
	 elseif(!empty($cartArray['productId_108'])){
	 	Session::set('cartSessData.productId_108', $previousSession);
	
	 }
	  elseif(!empty($cartArray['productId_109'])){
	 	Session::set('cartSessData.productId_109', $previousSession);
	
	 }
	 else{

	 }

     }


         if($_POST['productPageName']=='super-mom-bundle.php'){
     	if(!empty($cartArray['productId_117'])){
	 	Session::set('cartSessData.productId_117', $previousSession);
	 
	 	
	 }
	 elseif(!empty($cartArray['productId_118'])){
	 	Session::set('cartSessData.productId_118', $previousSession);
	
	 }else{

	 }

     }
           // if partypackcoco.php
 if($_POST['productPageName']=='partypack-coco.php'){

     if(!empty($cartArray['productId_90'])){
	 	Session::set('cartSessData.productId_90', $previousSession);

	 }if(!empty($cartArray['productId_91'])){
	 	Session::set('cartSessData.productId_91', $previousSession);
	 	
	 }
	 else{
	 	//Session::set('cartSessData.productId_'.$productID, $productDetails);
	 }


    }

               // if partypackpine.php
 if($_POST['productPageName']=='partypack-pine.php'){

     if(!empty($cartArray['productId_92'])){
	 	Session::set('cartSessData.productId_92', $previousSession);

	 }if(!empty($cartArray['productId_93'])){
	 	Session::set('cartSessData.productId_93', $previousSession);
	 	
	 }
	 else{
	 	//Session::set('cartSessData.productId_'.$productID, $productDetails);
	 }


    }

                   // if bra-bearies.php
 if($_POST['productPageName']=='bra-bearies.php'){

     if(!empty($cartArray['productId_96'])){
	 	Session::set('cartSessData.productId_96', $previousSession);

	 }if(!empty($cartArray['productId_97'])){
	 	Session::set('cartSessData.productId_97', $previousSession);
	 	
	 }
	   if(!empty($cartArray['productId_102'])){
	 	Session::set('cartSessData.productId_102', $previousSession);

	 }if(!empty($cartArray['productId_103'])){
	 	Session::set('cartSessData.productId_103', $previousSession);
	 	
	 }
	 if(!empty($cartArray['productId_104'])){
	 	Session::set('cartSessData.productId_104', $previousSession);

	 }if(!empty($cartArray['productId_105'])){
	 	Session::set('cartSessData.productId_105', $previousSession);
	 	
	 }
	 else{
	 	//Session::set('cartSessData.productId_'.$productID, $productDetails);
	 }


    }

    if($_POST['productPageName']=='tub-cubs.php'){

         if(!empty($cartArray['productId_110'])){
    	 	Session::set('cartSessData.productId_110', $previousSession);

    	 }if(!empty($cartArray['productId_111'])){
    	 	Session::set('cartSessData.productId_111', $previousSession);
    	 	
    	 }
    	   if(!empty($cartArray['productId_60'])){
    	 	Session::set('cartSessData.productId_60', $previousSession);

    	 }if(!empty($cartArray['productId_61'])){
    	 	Session::set('cartSessData.productId_61', $previousSession);
    	 	
    	 }
    	 if(!empty($cartArray['productId_62'])){
    	 	Session::set('cartSessData.productId_62', $previousSession);

    	 }if(!empty($cartArray['productId_63'])){
    	 	Session::set('cartSessData.productId_63', $previousSession);
    	 	
    	 }
    	 else{
    	 	//Session::set('cartSessData.productId_'.$productID, $productDetails);
    	 }
    }

    //cbd-cbn-oil-for-sleep
     if($_POST['productPageName']=='cbd-cbn-oil-for-sleep.php'){

         if(!empty($cartArray['productId_119'])){
    	 	Session::set('cartSessData.productId_119', $previousSession);

    	 }if(!empty($cartArray['productId_120'])){
    	 	Session::set('cartSessData.productId_120', $previousSession);
    	 	
    	 }
    	   if(!empty($cartArray['productId_121'])){
    	 	Session::set('cartSessData.productId_121', $previousSession);

    	 }if(!empty($cartArray['productId_122'])){
    	 	Session::set('cartSessData.productId_122', $previousSession);
    	 	
    	 }
    	 if(!empty($cartArray['productId_123'])){
    	 	Session::set('cartSessData.productId_123', $previousSession);

    	 }if(!empty($cartArray['productId_124'])){
    	 	Session::set('cartSessData.productId_124', $previousSession);
    	 	
    	 }
    	 else{
    	 	//Session::set('cartSessData.productId_'.$productID, $productDetails);
    	 }
    }
	
	Session::set('cartSessData.productId_'.$productID, $productDetails);	
	Session::set('cartSessData.productId_'.$productID.'.pagname', trim($_POST['productPageName']));
	
	 if(Session::has('cartSessData.productId_'.$productID)=='true'){

	 	header('Content-Type: application/json');
		echo json_encode(array('msg' => 'success'));
        //exit;
	  }else{
	  	echo json_encode(array('msg' => 'fail'));
	  }

}


