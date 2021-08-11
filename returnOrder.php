<?php
session_start();
include("assets/functions.php");
include("assets/db.php");
require_once('Notify/notify-php-master/autoload.php');
if(isset($_SESSION['customerId']))
{
   
    $cusId = $_SESSION['customerId'];
    
}





if(isset($_POST["productId"]) && isset($_POST["order_Id"]))  
{
    $orderId = $_POST["order_Id"];
    
    $getCartInformations = "SELECT `c_id` FROM `tbl_sales_order` WHERE s_orderId = '$orderId'";
    $cartIdDetails = mysqli_fetch_array(mysqli_query($con,$getCartInformations));
    $cartId = $cartIdDetails['c_id'];
    
    $pro_Ids = $_POST['productId'];
    date_default_timezone_set('Asia/Colombo');
    $s_ReturnDate = date('Y-m-d G:i:s ', time());
    
    $allProIds = "$pro_Ids";
    $myArray = explode(',', $allProIds);
    
    $countErrors = 0;
    
        foreach ($myArray as $proId) {
            
            $getMaxSReturnId = "SELECT MAX(CAST(SUBSTR(TRIM(s_returnId),7) AS UNSIGNED)) AS saleReturnID FROM tbl_sales_return WHERE s_returnId RLIKE 'SRORD'";
            $sReturnIdDetails = mysqli_fetch_array(mysqli_query($con,$getMaxSReturnId));
            $currentMaxSReturnId = $sReturnIdDetails['saleReturnID'];
            if($currentMaxSReturnId == null || $currentMaxSReturnId == "")
            {
                $saleReturnId = "1";
            }
            else
            {
                $saleReturnId = $currentMaxSReturnId + 1;
            }
            
            $getProductTotalDetails = "SELECT `total` FROM `tbl_cart` WHERE `c_id` = '$cartId' and `product_id`='$proId'";
            $proTotData = mysqli_fetch_array(mysqli_query($con,$getProductTotalDetails));
            $proTotal = $proTotData['total'];
            
            $insertSalesReturn = "INSERT INTO `tbl_sales_return`(`s_returnId`, `cus_id`, `s_orderId`, `product_id`, `total`, `return_date`, `return_status`) VALUES ('SRORD-$saleReturnId','$cusId','$orderId','$proId','$proTotal','$s_ReturnDate','1')";
            $insertReturnResults = mysqli_query($con,$insertSalesReturn);
            
            if($insertReturnResults == 1)
            {
               
            }
            else
            {
                
                $countErrors = $countErrors + 1;
            }
           
        }
    
    if($countErrors == 0)
    {
        
                    $getAdminNoDetails = "SELECT `admin_number` FROM `tbl_admin` WHERE `admin_id` = 1";
                    $noDetails = mysqli_fetch_assoc(mysqli_query($con,$getAdminNoDetails));
                    $adminNo = $noDetails['admin_number'];
                    
                    $api_instance = new NotifyLk\Api\SmsApi();
                    $user_id = "11897"; // string | API User ID - Can be found in your settings page.
                    $api_key = "xTbtIOAWowbMobSXYPwd"; // string | API Key - Can be found in your settings page.
                    $message = "New Sales Return Order has been placed - Warnasiri FoodCity"; // string | Text of the message. 320 chars max.
                    $to = "$adminNo"; // string | Number to send the SMS. Better to use 9471XXXXXXX format.
                    $sender_id = "Warnasiri FoodCity";
                    $contact_fname = ""; // string | Contact First Name - This will be used while saving the phone number in your Notify contacts.
                    $contact_lname = ""; // string | Contact Last Name - This will be used while saving the phone number in your Notify contacts.
                    $contact_email = ""; // string | Contact Email Address - This will be used while saving the phone number in your Notify contacts.
                    $contact_address = ""; // string | Contact Physical Address - This will be used while saving the phone number in your Notify contacts.
                    $contact_group = 0; // int | A group ID to associate the saving contact with



                    try {
                        $api_instance->sendSMS($user_id, $api_key, $message, $to, $sender_id, $contact_fname, $contact_lname, $contact_email, $contact_address, $contact_group);
                        //echo "$random_no";
                    } catch (Exception $e){
                        //echo "123";
                       // echo 'Exception when calling SmsApi->sendSMS: ', $e->getMessage(), PHP_EOL;
                    }
        
        
        echo "Return order has been placed, Once Confirm our team member will contact you- Thankyou!";
        
    }
    else
    {
        $deleteInsertedRecords = "DELETE FROM `tbl_sales_return` WHERE `s_orderId` = 'ORD-1'";
        $deleteResults = mysqli_query($con,$deleteInsertedRecords);
        if($deleteResults == 1)
        {
            echo "Something went wrong - Please Try Again!";
        }
    } 
    
    
    
}





?>