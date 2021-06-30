<?php
// DataBase Connection

$db_password="E(A~D)!KrnGF";
$db_name="sundayscaries_memDbBeta";
$db_username="sundayscaries_memUserBeta";
$GLOBALS['conn'] = mysqli_connect("localhost",$db_username,$db_password,$db_name);
$conn=$GLOBALS['conn'];
 DEFINE('DOMAIN','https://beta.sundayscaries.com/');


 function checkEmail($email,$tableName,$conn){
       $sql="select email from ".$tableName." where email='$email'";     
       $result = mysqli_query($GLOBALS['conn'], $sql);
       return $result;
  }
  //===================================================================================================================================
   function checkRreferrerEmail($email,$tableName,$conn){
       $sql="select referrer_email from ".$tableName." where referrer_email='$email'";     
       $result = mysqli_query($GLOBALS['conn'], $sql);

       return $result;
  }

  function checkReferece($tbl,$referrer_email,$referrer_code){
    $sql="select * from ".$tbl." where referred_email='$referrer_email' and referrer_code='$referrer_code'";     
       $result = mysqli_query($GLOBALS['conn'], $sql);

       return $result;

  }
  function checkRefereceStatus($tbl,$referrer_email,$referrer_code){
    $sql="select * from ".$tbl." where referred_email='$referrer_email' and referrer_code='$referrer_code' and status='0'";     
       $result = mysqli_query($GLOBALS['conn'], $sql);

       return $result;

  }
  function updateReferenceStatus($tbl,$referred_email,$referrer_code,$order_id){
   $sql="update ".$tbl." set status='1',orderId='$order_id' where referred_email='$referred_email' and referrer_code='$referrer_code'"; 

    $result =mysqli_query($GLOBALS['conn'], $sql);

    return $result;

  }
  function updateRankForReferUser($tbl,$referrer_code){
    $sql="update ".$tbl." set referrer_rank = referrer_rank + 1 where referrer_code='$referrer_code'"; 

    $result =mysqli_query($GLOBALS['conn'], $sql);

    return $result;
  }

  function getReferrelProducts(){
    $sql="select * from tbl_referral_products where  status='Y' ";     
       $result = mysqli_query($GLOBALS['conn'], $sql);
       while($data=mysqli_fetch_array($result)){
          $resultData[]=$data;
       }
    
       return $resultData;

      
  }

  function checkAlreadyRedeemed($tbl,$product_id,$referrer_code){
    $sql="select * from ".$tbl." where product_id='$product_id' and referrer_code='$referrer_code'";     
       $result = mysqli_query($GLOBALS['conn'], $sql);

       return $result;


  }
  //============================================================================================================================

  function memberDetails($email,$tableName){
   
       $sql="select * from ".$tableName." where email='$email'";         
       $result = mysqli_query($GLOBALS['conn'], $sql);
       $result=mysqli_fetch_object($result);
       $result=(array)$result;
       
       return $result;
  }


   function geftGiftCardDetails($email,$tableName,$conn){
       $sql="select * from ".$tableName." where user_email='$email'"; 
       $result = mysqli_query($GLOBALS['conn'], $sql);    
       $result=mysqli_fetch_object($result);
       $result=(array)$result;
       return $result;
  }

   function getReferalCode($email,$tableName,$conn){
       $sql="select * from ".$tableName." where referrer_email='$email'"; 
       $result = mysqli_query($GLOBALS['conn'], $sql);    
       $result=mysqli_fetch_object($result);
       $result=(array)$result;
       
       return $result;
  }

  function getReferralEmail($referrer_code,$tableName) {
    $sql = "SELECT referrer_email FROM $tableName WHERE referrer_code='$referrer_code';";
    $result = mysqli_query($GLOBALS['conn'], $sql);    
    $result=mysqli_fetch_object($result);
    $result=(array)$result;
    
    return $result;
  }

   function geftGiftCardDetailsByOrder($email,$orderId,$tableName,$conn){
       $sql="select * from ".$tableName." where user_email='$email' and exsiting_order_id='$orderId' and gift_card_id='285'"; 
       $result = mysqli_query($GLOBALS['conn'], $sql);    
       $result=mysqli_fetch_object($result);
       $result=(array)$result;
       return $result;
  }

   function appliedFor50Percent($tableName,$email,$orderId,$purchaseId){
      $sql="select * from ".$tableName." where emailAddress='$email' and cancel_purchase_id='$purchaseId'"; 
       $result = mysqli_query($GLOBALS['conn'], $sql);    
       $result=mysqli_fetch_object($result);
       $result=(array)$result;

       return $result;
   }
      function checkPurchaseModified($purchaseId,$tableName){
      $sql="select * from ".$tableName." where processed='0' and cancel_purchase_id='$purchaseId'"; 
       $result = mysqli_query($GLOBALS['conn'], $sql);    
       $result=mysqli_fetch_object($result);
       $result=(array)$result;

       return $result;
   }

 

   function giftCardExsit($tableName,$email,$orderId){
     $sql="select * from ".$tableName." where user_email='$email' and exsiting_order_id='$orderId' and gift_card_id='285'"; 
       $result = mysqli_query($GLOBALS['conn'], $sql);    
       $result=mysqli_fetch_object($result);
       $result=(array)$result;
       return $result;
   }
    function giftCardExsitForPurchase($tableName,$email,$orderId,$purchaseId){
     $sql="select * from ".$tableName." where user_email='$email' and exsiting_order_id='$orderId' and purchase_id='$purchaseId' and gift_card_id='285'"; 
       $result = mysqli_query($GLOBALS['conn'], $sql);    
       $result=mysqli_fetch_object($result);
       $result=(array)$result;
       return $result;
   }

     function memberSubscriptionData($email,$tableName) {
   

    $sql="select * from ".$tableName." where emailAddress='$email' and processed='0'"; 
    $result =mysqli_query($GLOBALS['conn'], $sql);

    $final_data = array(); // create an array
    while($row = mysqli_fetch_assoc($result)){ // iterate over the result-set object to get all data
        $final_data[] = $row; //assign value to the array
    }
    return $final_data; // return array
  }

     function memberCancelDowngrades($email,$tableName,$orderId,$purchaseId) {
   

    $sql="update ".$tableName." set processed='1' where emailAddress='$email' and cancel_orderId='$orderId' and cancel_purchase_id='$purchaseId' and processed='0'"; 

    $result =mysqli_query($GLOBALS['conn'], $sql);

    return $result;
  }

    function InsertData($tableName='',$fieldNames=''){

        $fields  = implode(',', array_keys($fieldNames)); 
        $arrayValues=array_values($fieldNames);
       
         if(count($arrayValues)>0){
          foreach($arrayValues as $key =>$val){

            $dataNew[]="'".mysqli_real_escape_string($GLOBALS['conn'], $val)."'";
          
          }
         }
            $values=implode(',',$dataNew);

 $insertQuery ="INSERT into ".$tableName."(".$fields.")". "VALUES (".$values.")";


        $result=mysqli_query($GLOBALS['conn'], $insertQuery);            

       return $result;
            }



    function allData($tableName){

      
       $sql="select * from ".$tableName." where active='1' ORDER BY createdAt ASC"; 
       $result = mysqli_query($GLOBALS['conn'], $sql);    
       while($data=mysqli_fetch_array($result)){
          $resultData[]=$data;
       }
    
       return $resultData;

            }

  function allDataFromMembership($tableName,$startlimit,$endLimit){

      
  $sql="SELECT membership.email,membership.customer_Id FROM membership LEFT JOIN tbl_referrals ON tbl_referrals.referrer_email = membership.email WHERE tbl_referrals.referrer_email IS NULL";
       $result = mysqli_query($GLOBALS['conn'], $sql);    
       while($data=mysqli_fetch_array($result)){
          $resultData[]=$data;
       }
    
       return $resultData;

            }


      function allDataReferal($tableName){

      
 $sql="select * from ".$tableName." where status='0' order by id limit 100"; 
       $result = mysqli_query($GLOBALS['conn'], $sql);    
       while($data=mysqli_fetch_array($result)){
          $resultData[]=$data;
       }
    
       return $resultData;

            }


            function updateKlaviyoStatus($tbl,$referrer_code){
      
 
          
         $sql="update ".$tbl." SET  status='1' where referrer_code='$referrer_code'";
         
          $result = mysqli_query($GLOBALS['conn'], $sql);    
        
          return $result;

            }

    function allDataByLimit($tableName, $limit){

      
       $sql="select * from ".$tableName." where active='1' ORDER BY id DESC LIMIT $limit"; 
       $result = mysqli_query($GLOBALS['conn'], $sql);    
       while($data=mysqli_fetch_array($result)){
          $resultData[]=$data;
       }
    
       return $resultData;

            }
            
    function allDowngradeSubscriptionsData($tableName){
      
       $sql="select * from ".$tableName." WHERE customerId <> '' ORDER BY createdAt DESC"; 
       $result = mysqli_query($GLOBALS['conn'], $sql);    
       while($data=mysqli_fetch_array($result)){
          $resultData[]=$data;
       }
    
       return $resultData;

    }

    function allpausedSubscriptionsData($tableName){
       $sql="select * from ".$tableName." ORDER BY createdAt DESC"; 
       $result = mysqli_query($GLOBALS['conn'], $sql);    
       while($data=mysqli_fetch_array($result)){
          $resultData[]=$data;
       }
    
       return $resultData;
    }




   function getSingleRowWholeSale($tblName,$fieldValue){
     $sql="select * from ".$tblName." where emailId='$fieldValue' and active='1'"; 
       $result = mysqli_query($GLOBALS['conn'], $sql);    
       $result=mysqli_fetch_object($result);
       $result=(array)$result;
       return $result;

  
   }

  function updateWholeSaleStatus($tbl,$updateTblFieldVal,$email){
         $tblName=trim($tbl);
         $fieldName=array_keys($updateTblFieldVal);
         $fieldValue=array_values($updateTblFieldVal);
         $emailId=trim($email);
        $fieldValue[0]=mysqli_real_escape_string($GLOBALS['conn'],$fieldValue[0]);
         $fieldValue[1]=mysqli_real_escape_string($GLOBALS['conn'],$fieldValue[1]);
          
         $sql="update ".$tblName." SET $fieldName[0]='$fieldValue[0]' where emailId='$emailId' and active='1'";
         
          $result = mysqli_query($GLOBALS['conn'], $sql);    
        
          return $result;

            
         }
  function checkEmailWholeSale($email,$tableName){
       $sql="select emailId from ".$tableName." where emailId='$email'";     
       $result = mysqli_query($GLOBALS['conn'], $sql);
       return $result;
  }

  
// Update product Type for  User in membership table
   function updateProductType($tblName,$updateTblFieldVal){
         $product_type=mysqli_real_escape_string($GLOBALS['conn'],$updateTblFieldVal['product_type']);
         $email=mysqli_real_escape_string($GLOBALS['conn'],$updateTblFieldVal['email']);    

      $sql="update ".$tblName." SET product_type='".$product_type."' where email='".$email."' and active='1'";
        $result = mysqli_query($GLOBALS['conn'], $sql);  

        
         return $result;

   }

   // Update email status for First Time User in membership table
   function updateEmailStatus($tblName,$updateTblFieldVal){
         $email_status=mysqli_real_escape_string($GLOBALS['conn'],$updateTblFieldVal['email_status']);
         $email=mysqli_real_escape_string($GLOBALS['conn'],$updateTblFieldVal['email']);    

      $sql="update ".$tblName." SET email_status='".$email_status."' where email='".$email."' and active='1'";
        $result = mysqli_query($GLOBALS['conn'], $sql);  

        
         return $result;

   }

     function getUserActivity($tblName,$fieldValue){
       $sql="select login_activity from ".$tblName." where email='$fieldValue' and active='1'"; 
     
       $result = mysqli_query($GLOBALS['conn'], $sql);    
       $result=mysqli_fetch_object($result);
       $result=(array)$result;
       return $result;

  
   }

// update login acitivity of user

   function updateLoginActivity($tblName,$email){
   
      $email=mysqli_real_escape_string($GLOBALS['conn'],$email);   
        

  $sql="update ".$tblName." SET login_activity=login_activity + 1 where email='".$email."' and active='1'";
 
        $result = mysqli_query($GLOBALS['conn'], $sql);  

         return $result;

   }

   function checkPassword($string){
       $sql="select * from membership where password='$string' or temp_password='$string'";     
       $result = mysqli_query($GLOBALS['conn'], $sql); 
        
       return $result->num_rows;
   }

    function updateTempPassword($data){
       $tempPassword=mysqli_real_escape_string($GLOBALS['conn'],$data['temp_password']); 
       $email=mysqli_real_escape_string($GLOBALS['conn'],$data['email']);           
    $sql="update ".$data['tblName']." SET  temp_password='".$tempPassword."',update_from_admin='Temp Password generated from member-list' where email='".$email."' and active='1'";

       $result = mysqli_query($GLOBALS['conn'], $sql);  
      return mysqli_affected_rows($GLOBALS['conn']);
    }

   function insertMemberInfo($data){
   
    $email_status = "N";

    $insertData['user_info'] = array('firstName'=>$data['firstName'],'lastName'=>$data['lastName'],'phone'=>$data['phoneNumber'],'shippingAddress1'=>$data['shipAddress1'],'shippingZip'=>$data['shipPostalCode'],'shippingCity'=>$data['shipCity'],'shippingState'=>$data['shipState'],'shippingCountry'=>$data['shipCountry']);
  
    $user_info = json_encode(array('user_info' => $insertData['user_info']), JSON_FORCE_OBJECT);

    $product_type = $data['subscriptPresent'] ? 'Subscription' : 'Onetime';
    $sql = "insert into membership (email, password, customer_Id, temp_password, user_info, active, email_status, product_type) values ('".$data['emailAddress']."', '".$data['temp_password']."', '".$data['customerId']."', '".$data['temp_password']."', '".$user_info."', '1', '".$email_status."','".$product_type."')";

    $result = mysqli_query($GLOBALS['conn'], $sql);
 
    return $result;
   }

   function sendEmail($data){
      $memberDetails=memberDetails(trim($data['email']),'membership');
      $userInfo=json_decode($memberDetails['user_info']);
      $userInfo=(array)$userInfo->user_info;

      if(!empty($data['subscriptPresent']) &&  $data['subscriptPresent']==1){
        $mailSub="ENCLOSED: Important Membership Dashboard Benefits";
        $mailSub = '=?UTF-8?B?'.base64_encode($mailSub).'?=';
        $mail_temp_name="new-monthly.html";
      }else{
        $mailSub="ENCLOSED: Important Membership Dashboard Benefits";
        $mailSub = '=?UTF-8?B?'.base64_encode($mailSub).'?=';
        $mail_temp_name="new-one-time.html";
      }

          $emailData['firstName']=$userInfo['firstName'];
          $emailData['temp_password']=$memberDetails['temp_password'];
          $emailData['mail_sub']=$mailSub;
          $emailData['mail_temp_name']=$mail_temp_name;
          $emailData['email']=trim($data['email']);
       
   
        if(sendMail($emailData)){
          return true;
        }
        else{
          return false;
        }
   }

   function checkReferrelCodeExsit($tbl,$referrer_code) {
    $sql="select * from ".$tbl." where referrer_code='$referrer_code'";     
       $result = mysqli_query($GLOBALS['conn'], $sql); 
        
       return $result->num_rows;
   }
   function checkUserEmail($tbl,$referred_email,$referrer_code){
    $sql="select * from ".$tbl." where referrer_code='$referrer_code' and referrer_email='$referred_email'";     
       $result = mysqli_query($GLOBALS['conn'], $sql); 
        
       return $result->num_rows;
   }

     function checkAlreadyRefered($tbl,$referrer_code,$referred_email) {
   $sql="select * from ".$tbl." where referrer_code='$referrer_code' and referred_email='$referred_email'";     
       $result = mysqli_query($GLOBALS['conn'], $sql); 
        
       return $result->num_rows;
   }

    function updateReferalrankFromNextBee($tblName,$data){
       $referrer_email=mysqli_real_escape_string($GLOBALS['conn'],$data['referrer_email']); 
       $referrer_rank=mysqli_real_escape_string($GLOBALS['conn'],$data['referrer_rank']);           
       $sql="update ".$tblName." SET  referrer_rank='".$referrer_rank."' where referrer_email='".$referrer_email."'";

       $result = mysqli_query($GLOBALS['conn'], $sql);  
      return mysqli_affected_rows($GLOBALS['conn']);
    }

        function howManyPeopleAreUstingRefferalLink($tbl){
     $sql="select DISTINCT(referrer_code) from ".$tbl.""; 
       $result = mysqli_query($GLOBALS['conn'], $sql);    
       while($data=mysqli_fetch_array($result)){
          $resultData[]=$data;
       }
    
       return $resultData;

    }

    function howManyPurchseMade($tbl){
     $sql="select count(distinct orderId) as purchase_count from ".$tbl." where status='1'"; 
       $result = mysqli_query($GLOBALS['conn'], $sql);    
       while($data=mysqli_fetch_array($result)){
          $resultData[]=$data;
       }
    
       return $resultData;

    }
    function howmanyRewardRedeems($tbl){
     $sql="select DISTINCT referrer_code from ".$tbl.""; 
       $result = mysqli_query($GLOBALS['conn'], $sql);    
       while($data=mysqli_fetch_array($result)){
          $resultData[]=$data;
       }
    
       return $resultData;

    }
    function whichRewardBeingRedeem($tbl){
      $sql="select  product_id, count(id) from ".$tbl." group by product_id"; 
       $result = mysqli_query($GLOBALS['conn'], $sql);    
       while($data=mysqli_fetch_array($result)){
          $resultData[]=$data;
       }
    
       return $resultData;

    }

    function allPurchaseData($tbl){
      $sql="SELECT DISTINCT $tbl.orderId, tbl_referrals.referrer_email FROM $tbl INNER JOIN tbl_referrals ON $tbl.referrer_code=tbl_referrals.referrer_code WHERE $tbl.status='1'"; 
       $result = mysqli_query($GLOBALS['conn'], $sql);    
       while($data=mysqli_fetch_array($result)){    
          $resultData[]=$data;
       }
    
       return $resultData;
    }

    function allReferrerData(){
      $sql="SELECT DISTINCT referrer.referrer_code, referral.referrer_email AS emailAddress, referral.referrer_rank, referral.created_on, membership.user_info FROM tbl_reference AS referrer INNER JOIN tbl_referrals AS referral ON referrer.referrer_code=referral.referrer_code INNER JOIN membership ON referral.referrer_email=membership.email";
      $result = mysqli_query($GLOBALS['conn'], $sql);    
       while($data=mysqli_fetch_array($result)){    
          $resultData[]=$data;
       }
    
       return $resultData;
    }

    function allRewardsData(){
      $sql="SELECT DISTINCT reward.referrer_code, GROUP_CONCAT(product.referral_product_name SEPARATOR ', ') AS product_names, referral.referrer_email AS emailAddress, reward.createdAt, membership.user_info FROM tbl_product_redeem AS reward INNER JOIN tbl_referrals AS referral ON reward.referrer_code=referral.referrer_code INNER JOIN membership ON referral.referrer_email=membership.email INNER JOIN tbl_referral_products AS product ON reward.product_id=product.id GROUP BY reward.referrer_code";
      $result = mysqli_query($GLOBALS['conn'], $sql);    
       while($data=mysqli_fetch_array($result)){    
          $resultData[]=$data;
       }
    
       return $resultData;
    }

    /***************************************************************************************************************
    * Modify Orders Dashboard.
    */
    function getModifiedOrders($tableName, $args) {
      $where = "";
      foreach ($args as $key => $value) {
        $where .= "$key = '$value' AND ";
      }
      $sql = "SELECT * FROM $tableName WHERE $where processed = 0;";

      $result = mysqli_query($GLOBALS['conn'], $sql);
      $data = [];
      while($row = mysqli_fetch_object($result)) {
        $data[] = (array) $row;
      }
      return $data;
    }

    function updateModifiedOrders($tableName, $id, $args) {
      $setValues = "";
      foreach ($args as $key => $value) {
        $setValues .= "$key = '$value',";
      }
      $setValues = rtrim($setValues, ',');
      $sql = "UPDATE $tableName SET $setValues WHERE id = $id;";
      $result = mysqli_query($GLOBALS['conn'], $sql);
      return $result;
      echo $result; die();
    }

     function checkWithReferanceTable($referred_email,$tbl){
       $sql="select * from ".$tbl." where referred_email='$referred_email' and status='0'";     
        $result = mysqli_query($GLOBALS['conn'], $sql);
        $result=mysqli_fetch_object($result);
        $result=(array)$result;

       return $result;

  }
   function fetechemailbytemppass($temp_password,$tableName,$conn){
       $sql="select email from ".$tableName." where temp_password='$temp_password'";     
    
       $result = mysqli_query($GLOBALS['conn'], $sql);    
       while($data=mysqli_fetch_array($result)){
          $resultData[]=$data;
       }
    
       return $resultData;
    
  }

  function updateTblStatus($tbl,$id){
$sql="update ".$tbl." set status='1' where id='$id'"; 
  

    $result =mysqli_query($GLOBALS['conn'], $sql);

    return $result;

  }
    
 ?>