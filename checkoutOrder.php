<?php
session_start();
include("assets/functions.php");
include("assets/db.php");
require_once('Notify/notify-php-master/autoload.php');
if(isset($_SESSION['customerId']))
{
    $cusId = $_SESSION['customerId'];
}



if(isset($_POST["saveToProfile"]))  
{
    date_default_timezone_set('Asia/Colombo');
       $orderDate = date('Y-m-d G:i:s ', time());
    
    
    $customerFName = $_POST["fName"];
    $customerLName = $_POST["lName"];
    $customerEmail = $_POST["emailAddress"];
    $customerNic = $_POST["nicNo"];
    $customerCity = $_POST["cityName"];
    $customerAddress = $_POST["cusAddress"];
    $customerNumber = $_POST["verifiedCustomerNumber"];
     $paymentType = $_POST["payType"];
    
    $saveCustomerQuery = "UPDATE `tbl_customer` SET `cus_fname`='$customerFName',`cus_lname`='$customerLName',`cus_tele`='$customerNumber',`cus_nic`='$customerNic',`cus_city`='$customerCity',`cus_address`='$customerAddress' WHERE cus_id='$cusId'";
    $updateCustomer = mysqli_query($con,$saveCustomerQuery);
    
    if($updateCustomer == 1)
    {
        
    $getCartId = "SELECT DISTINCT c_id FROM `tbl_cart` WHERE cus_id = '$cusId' and status ='0'";
    $cartIdResults = mysqli_query($con,$getCartId);
    $cartIdData = mysqli_fetch_assoc($cartIdResults);
    $cartId = $cartIdData['c_id'];
    $notAvailbleProducts = 0;
    $TotalBillAmount = 0;
    $checkForNotAvailableProducts = "SELECT product_id,quantity FROM `tbl_cart` WHERE c_id = '$cartId'";
    $cartProductDetails = mysqli_query($con,$checkForNotAvailableProducts);
    while($productDetails = mysqli_fetch_array($cartProductDetails))
    {
        $productId = $productDetails['product_id'];
        $productQty = $productDetails['quantity'];
        
        $checkForAvailablilityQuery = "SELECT `pro_available_stock`,`pro_available_status`,`pro_display_price`,`pro_discount_status`,`pro_discount_amount` FROM `tbl_product` WHERE pro_id = '$productId'";
        $availResultsData = mysqli_query($con,$checkForAvailablilityQuery);
        $availableDetails = mysqli_fetch_array($availResultsData);
        $stockCount = $availableDetails['pro_available_stock'];
        $availbleStatus = $availableDetails['pro_available_status'];
        $discountStatus = $availableDetails['pro_discount_status'];
        $discountAmount = $availableDetails['pro_discount_amount'];
        $proPrice = $availableDetails['pro_display_price'];
        
        if($availbleStatus == 1 && $stockCount >= $productQty)
        {
            if($discountStatus == 1)
            {
                $discountedPrice = $proPrice - (($discountAmount * $proPrice) / 100);
                $TotalBillAmount = $TotalBillAmount + ($productQty * $discountedPrice);
            }
            else
            {
                $TotalBillAmount = $TotalBillAmount + ($productQty * $proPrice);
            }
        }
        else
        {
            $notAvailbleProducts = $notAvailbleProducts + 1;
        }
        
    }
    if($notAvailbleProducts == 0)
    {
        //all are avaible products
        $getMaxOrderIDQuery = "SELECT MAX(CAST(SUBSTR(TRIM(s_orderId),5) AS UNSIGNED)) AS maxOrderId FROM tbl_sales_order WHERE s_orderId RLIKE 'ORD'";
        $maxOrderIdResults = mysqli_query($con,$getMaxOrderIDQuery);
        $maxOrderIdDetails = mysqli_fetch_assoc($maxOrderIdResults);
        $maxOrderID = $maxOrderIdDetails['maxOrderId'];
        if($maxOrderID == null || $maxOrderID == "")
        {
            $maxOrderID = 1;
        }
        else
        {
            $maxOrderID = $maxOrderID + 1;
        }
        
        $placeOrderQuery = "INSERT INTO `tbl_sales_order`(`s_orderId`, `c_id`, `order_date`, `total`, `cus_fname`, `cus_lname`, `cus_nic`, `cus_address`, `cus_city`, `cus_tele`, `cus_email`, `order_status`) VALUES ('ORD-$maxOrderID','$cartId','$orderDate','$TotalBillAmount','$customerFName','$customerLName','$customerNic','$customerAddress','$customerCity','$customerNumber','$customerEmail','1')";
        
        
        $getMaxPaymentIDQuery = "SELECT MAX(CAST(SUBSTR(TRIM(pay_id),5) AS UNSIGNED)) AS maxPayId FROM tbl_payment WHERE pay_id RLIKE 'PAY'";
        $maxPayIdResults = mysqli_query($con,$getMaxPaymentIDQuery);
        $maxPayIdDetails = mysqli_fetch_assoc($maxPayIdResults);
        $maxPayID = $maxPayIdDetails['maxPayId'];
        if($maxPayID == null || $maxPayID == "")
        {
            $maxPayID = 1;
        }
        else
        {
            $maxPayID = $maxPayID + 1;
        }
        
        if($paymentType == "Cash On Delivery")
        {
            $displayStatus ="Pending..";
        }
        else
        {
            $displayStatus ="Paid";
        }
        
        
        $placeOrderPaymentQuery = "INSERT INTO `tbl_payment`(`pay_id`, `pay_date`, `method`, `s_orderId`, `pay_status`, `total`) VALUES ('PAY-$maxPayID','$orderDate','$paymentType','ORD-$maxOrderID','$displayStatus','$TotalBillAmount')";
        $paymentDetailsPlacedResult = mysqli_query($con,$placeOrderPaymentQuery);
        
        
        
        
        $orderPlacedResult = mysqli_query($con,$placeOrderQuery);
        if($orderPlacedResult == 1 && $paymentDetailsPlacedResult == 1)
        {
            $updateCartErrors = 0;
            $selectsCartToUpdateQuery = "SELECT * FROM `tbl_cart` WHERE `c_id` = '$cartId' AND `status` = '0'";
            $selectCartToUpdateResults = mysqli_query($con,$selectsCartToUpdateQuery);
            while($cartRow = mysqli_fetch_array($selectCartToUpdateResults))
            {
                $totalValue = 0;
                
                $proId = $cartRow['product_id'];
                $proQty = $cartRow['quantity'];
                
                $getOtherProDetails = "SELECT * FROM `tbl_product` WHERE `pro_id` = '$proId'";
                $otherProDetailResults = mysqli_query($con,$getOtherProDetails);
                $allOtherDetails = mysqli_fetch_array($otherProDetailResults);
                
                $disStatus = $allOtherDetails['pro_discount_status'];
                $disAmount = $allOtherDetails['pro_discount_amount'];
                $proAmount = $allOtherDetails['pro_display_price'];
                
                
                if($disStatus == 1)
                {
                    $disAmountValue = $proAmount - (($disAmount * $proAmount) / 100);
                    $totalValue = $totalValue + ($disAmountValue * $proQty);
                }
                else
                {
                    $totalValue = $totalValue + ($proAmount * $proQty);
                }
                
                $updateCartQuery = "UPDATE `tbl_cart` SET `total`='$totalValue',`status`='1' WHERE `c_id` = '$cartId' and `product_id` = '$proId'";
                $updateCartResults = mysqli_query($con,$updateCartQuery);
                if($updateCartResults == 1)
                {
                   
                }
                else
                {
                    $updateCartErrors = $updateCartErrors + 1;
                }
            }
            if($updateCartErrors == 0)
            {
                //go update stock
                $updateStockErrors = 0;
                $getAllProductInCart = "SELECT * FROM `tbl_cart` WHERE `c_id` = '$cartId'";
                $getAllCartProductResults = mysqli_query($con,$getAllProductInCart);
                while($cartProductDetailsToUpdate = mysqli_fetch_array($getAllCartProductResults))
                {
                    $cartProId = $cartProductDetailsToUpdate['product_id'];
                    $cartProductQty = $cartProductDetailsToUpdate['quantity'];
                    
                    $getOtherDetailsOfProduct = "SELECT * FROM `tbl_product` WHERE `pro_id` = '$cartProId'";
                    $gotOtherDetailsOfProductResults = mysqli_query($con,$getOtherDetailsOfProduct);
                    $otherDetailsOfProduct = mysqli_fetch_array($gotOtherDetailsOfProductResults);
                    
                    $proStock = $otherDetailsOfProduct['pro_available_stock'];
                    $proRemainStock = $proStock - $proQty;
                    
                    if($proRemainStock == 0)
                    {
                        $updateProductStockQuery = "UPDATE `tbl_product` SET `pro_available_stock`= '$proRemainStock', `pro_available_status` = '0' WHERE pro_id = '$cartProId'";
                        $updateProductStockResults = mysqli_query($con,$updateProductStockQuery);
                        if($updateProductStockResults == 1)
                        {

                        }
                        else
                        {
                            $updateStockErrors = $updateStockErrors + 1;
                        }  
                    }
                    else
                    {
                        
                   
                    
                        $updateProductStockQuery = "UPDATE `tbl_product` SET `pro_available_stock`= '$proRemainStock' WHERE pro_id = '$cartProId'";
                        $updateProductStockResults = mysqli_query($con,$updateProductStockQuery);
                        if($updateProductStockResults == 1)
                        {

                        }
                        else
                        {
                            $updateStockErrors = $updateStockErrors + 1;
                        }
                   }
                }
                if($updateStockErrors == 0)
                {
                    //finish
                     
                    $api_instance = new NotifyLk\Api\SmsApi();
                    $user_id = "11897"; // string | API User ID - Can be found in your settings page.
                    $api_key = "xTbtIOAWowbMobSXYPwd"; // string | API Key - Can be found in your settings page.
                    $message = "Hi $customerFName, \nYour order #ORD-$maxOrderID has been placed. Once confirmed we will send the bill and let you know\nThank You!\n-Warnasiri FoodCity"; // string | Text of the message. 320 chars max.
                    $to = "$customerNumber"; // string | Number to send the SMS. Better to use 9471XXXXXXX format.
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
                    
                    $getAdminNoDetails = "SELECT `admin_number` FROM `tbl_admin` WHERE `admin_id` = 1";
                    $noDetails = mysqli_fetch_assoc(mysqli_query($con,$getAdminNoDetails));
                    $adminNo = $noDetails['admin_number'];
                    
                    $api_instance = new NotifyLk\Api\SmsApi();
                    $user_id = "11897"; // string | API User ID - Can be found in your settings page.
                    $api_key = "xTbtIOAWowbMobSXYPwd"; // string | API Key - Can be found in your settings page.
                    $message = "New Order #ORD-$maxOrderID has been place - Warnasiri FoodCity"; // string | Text of the message. 320 chars max.
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
                    
                    
                    echo "Your Order Has Been Placed - Thankyou!";
                }
                else
                {
                    $deleteOrder = "DELETE FROM `tbl_sales_order` WHERE `s_orderId` = 'ORD-$maxOrderID'";
                    $deleteResultsOrder = mysqli_query($con,$deleteOrder);
                    if($deleteResultsOrder == 1)
                    {
                        $reUpdateCartStatus = "UPDATE `tbl_cart` SET `status`='0' WHERE `c_id` = '$cartId'";
                        $reUpdateCartResults = mysqli_query($con,$reUpdateCartStatus);
                        if($reUpdateCartResults == 1)
                        {
                            echo "Error occured while placing your order - Please Try Again!";
                        }
                    }
                }
                
            }
            else
            {
                $deleteOrder = "DELETE FROM `tbl_sales_order` WHERE `s_orderId` = 'ORD-$maxOrderID'";
                $deleteResultsOrder = mysqli_query($con,$deleteOrder);
                if($deleteResultsOrder == 1)
                {
                    $reUpdateCartStatus = "UPDATE `tbl_cart` SET `status`='0' WHERE `c_id` = '$cartId'";
                    $reUpdateCartResults = mysqli_query($con,$reUpdateCartStatus);
                    if($reUpdateCartResults == 1)
                    {
                        echo "Error occured while placing your order - Please Try Again!";
                    }
                }
                
            }
            
        }
        else
        {
            echo "Error occured while placing your order - Please Try Again!";
        }
        
    }
    else
    {
        echo "Some of the Items to be checkout are not available. Please remove those items which are not available.";
    }
    }
    else
    {
        echo "Somthing went wrong - Please Try Again!";
    }
}



else if(isset($_POST["verifiedCustomerNumber"]) && !isset($_POST["saveToProfile"]))  
{
    date_default_timezone_set('Asia/Colombo');
       $orderDate = date('Y-m-d G:i:s ', time());
    
    $customerFName = $_POST["fName"];
    $customerLName = $_POST["lName"];
    $customerEmail = $_POST["emailAddress"];
    $customerNic = $_POST["nicNo"];
    $customerCity = $_POST["cityName"];
    $customerAddress = $_POST["cusAddress"];
    $customerNumber = $_POST["verifiedCustomerNumber"];
    $paymentType = $_POST["payType"];
       
    $getCartId = "SELECT DISTINCT c_id FROM `tbl_cart` WHERE cus_id = '$cusId' and status ='0'";
    $cartIdResults = mysqli_query($con,$getCartId);
    $cartIdData = mysqli_fetch_assoc($cartIdResults);
    $cartId = $cartIdData['c_id'];
    $notAvailbleProducts = 0;
    $TotalBillAmount = 0;
    $checkForNotAvailableProducts = "SELECT product_id,quantity FROM `tbl_cart` WHERE c_id = '$cartId'";
    $cartProductDetails = mysqli_query($con,$checkForNotAvailableProducts);
    while($productDetails = mysqli_fetch_array($cartProductDetails))
    {
        $productId = $productDetails['product_id'];
        $productQty = $productDetails['quantity'];
        
        $checkForAvailablilityQuery = "SELECT `pro_available_stock`,`pro_available_status`,`pro_display_price`,`pro_discount_status`,`pro_discount_amount` FROM `tbl_product` WHERE pro_id = '$productId'";
        $availResultsData = mysqli_query($con,$checkForAvailablilityQuery);
        $availableDetails = mysqli_fetch_array($availResultsData);
        $stockCount = $availableDetails['pro_available_stock'];
        $availbleStatus = $availableDetails['pro_available_status'];
        $discountStatus = $availableDetails['pro_discount_status'];
        $discountAmount = $availableDetails['pro_discount_amount'];
        $proPrice = $availableDetails['pro_display_price'];
        
        if($availbleStatus == 1 && $stockCount >= $productQty)
        {
            if($discountStatus == 1)
            {
                $discountedPrice = $proPrice - (($discountAmount * $proPrice) / 100);
                $TotalBillAmount = $TotalBillAmount + ($productQty * $discountedPrice);
            }
            else
            {
                $TotalBillAmount = $TotalBillAmount + ($productQty * $proPrice);
            }
        }
        else
        {
            $notAvailbleProducts = $notAvailbleProducts + 1;
        }
        
    }
    if($notAvailbleProducts == 0)
    {
        //all are avaible products
        $getMaxOrderIDQuery = "SELECT MAX(CAST(SUBSTR(TRIM(s_orderId),5) AS UNSIGNED)) AS maxOrderId FROM tbl_sales_order WHERE s_orderId RLIKE 'ORD'";
        $maxOrderIdResults = mysqli_query($con,$getMaxOrderIDQuery);
        $maxOrderIdDetails = mysqli_fetch_assoc($maxOrderIdResults);
        $maxOrderID = $maxOrderIdDetails['maxOrderId'];
        if($maxOrderID == null || $maxOrderID == "")
        {
            $maxOrderID = 1;
        }
        else
        {
            $maxOrderID = $maxOrderID + 1;
        }
        
        $placeOrderQuery = "INSERT INTO `tbl_sales_order`(`s_orderId`, `c_id`, `order_date`, `total`, `cus_fname`, `cus_lname`, `cus_nic`, `cus_address`, `cus_city`, `cus_tele`, `cus_email`, `order_status`) VALUES ('ORD-$maxOrderID','$cartId','$orderDate','$TotalBillAmount','$customerFName','$customerLName','$customerNic','$customerAddress','$customerCity','$customerNumber','$customerEmail','1')";
        
        
        $getMaxPaymentIDQuery = "SELECT MAX(CAST(SUBSTR(TRIM(pay_id),5) AS UNSIGNED)) AS maxPayId FROM tbl_payment WHERE pay_id RLIKE 'PAY'";
        $maxPayIdResults = mysqli_query($con,$getMaxPaymentIDQuery);
        $maxPayIdDetails = mysqli_fetch_assoc($maxPayIdResults);
        $maxPayID = $maxPayIdDetails['maxPayId'];
        if($maxPayID == null || $maxPayID == "")
        {
            $maxPayID = 1;
        }
        else
        {
            $maxPayID = $maxPayID + 1;
        }
        
        if($paymentType == "Cash On Delivery")
        {
            $displayStatus ="Pending..";
        }
        else
        {
            $displayStatus ="Paid";
        }
        
        
        $placeOrderPaymentQuery = "INSERT INTO `tbl_payment`(`pay_id`, `pay_date`, `method`, `s_orderId`, `pay_status`, `total`) VALUES ('PAY-$maxPayID','$orderDate','$paymentType','ORD-$maxOrderID','$displayStatus','$TotalBillAmount')";
        $paymentDetailsPlacedResult = mysqli_query($con,$placeOrderPaymentQuery);
        
        $orderPlacedResult = mysqli_query($con,$placeOrderQuery);
        if($orderPlacedResult == 1 && $paymentDetailsPlacedResult ==1)
        {
            $updateCartErrors = 0;
            $selectsCartToUpdateQuery = "SELECT * FROM `tbl_cart` WHERE `c_id` = '$cartId' AND `status` = '0'";
            $selectCartToUpdateResults = mysqli_query($con,$selectsCartToUpdateQuery);
            while($cartRow = mysqli_fetch_array($selectCartToUpdateResults))
            {
                $totalValue = 0;
                
                $proId = $cartRow['product_id'];
                $proQty = $cartRow['quantity'];
                
                $getOtherProDetails = "SELECT * FROM `tbl_product` WHERE `pro_id` = '$proId'";
                $otherProDetailResults = mysqli_query($con,$getOtherProDetails);
                $allOtherDetails = mysqli_fetch_array($otherProDetailResults);
                
                $disStatus = $allOtherDetails['pro_discount_status'];
                $disAmount = $allOtherDetails['pro_discount_amount'];
                $proAmount = $allOtherDetails['pro_display_price'];
                
                
                if($disStatus == 1)
                {
                    $disAmountValue = $proAmount - (($disAmount * $proAmount) / 100);
                    $totalValue = $totalValue + ($disAmountValue * $proQty);
                }
                else
                {
                    $totalValue = $totalValue + ($proAmount * $proQty);
                }
                
                $updateCartQuery = "UPDATE `tbl_cart` SET `total`='$totalValue',`status`='1' WHERE `c_id` = '$cartId' and `product_id` = '$proId'";
                $updateCartResults = mysqli_query($con,$updateCartQuery);
                if($updateCartResults == 1)
                {
                   
                }
                else
                {
                    $updateCartErrors = $updateCartErrors + 1;
                }
            }
            if($updateCartErrors == 0)
            {
                //go update stock
                $updateStockErrors = 0;
                $getAllProductInCart = "SELECT * FROM `tbl_cart` WHERE `c_id` = '$cartId'";
                $getAllCartProductResults = mysqli_query($con,$getAllProductInCart);
                while($cartProductDetailsToUpdate = mysqli_fetch_array($getAllCartProductResults))
                {
                    $cartProId = $cartProductDetailsToUpdate['product_id'];
                    $cartProductQty = $cartProductDetailsToUpdate['quantity'];
                    
                    $getOtherDetailsOfProduct = "SELECT * FROM `tbl_product` WHERE `pro_id` = '$cartProId'";
                    $gotOtherDetailsOfProductResults = mysqli_query($con,$getOtherDetailsOfProduct);
                    $otherDetailsOfProduct = mysqli_fetch_array($gotOtherDetailsOfProductResults);
                    
                    $proStock = $otherDetailsOfProduct['pro_available_stock'];
                    $proRemainStock = $proStock - $proQty;
                    
                    if($proRemainStock == 0)
                    {
                        $updateProductStockQuery = "UPDATE `tbl_product` SET `pro_available_stock`= '$proRemainStock', `pro_available_status` = '0' WHERE pro_id = '$cartProId'";
                        $updateProductStockResults = mysqli_query($con,$updateProductStockQuery);
                        if($updateProductStockResults == 1)
                        {

                        }
                        else
                        {
                            $updateStockErrors = $updateStockErrors + 1;
                        }  
                    }
                    else
                    {
                        
                   
                    
                        $updateProductStockQuery = "UPDATE `tbl_product` SET `pro_available_stock`= '$proRemainStock' WHERE pro_id = '$cartProId'";
                        $updateProductStockResults = mysqli_query($con,$updateProductStockQuery);
                        if($updateProductStockResults == 1)
                        {

                        }
                        else
                        {
                            $updateStockErrors = $updateStockErrors + 1;
                        }
                   }
                }
                if($updateStockErrors == 0)
                {
                    //finish
                    
                    $api_instance = new NotifyLk\Api\SmsApi();
                    $user_id = "11897"; // string | API User ID - Can be found in your settings page.
                    $api_key = "xTbtIOAWowbMobSXYPwd"; // string | API Key - Can be found in your settings page.
                    $message = "Hi $customerFName, \nYour order #ORD-$maxOrderID has been placed. Once confirmed we will send the bill and let you know\nThank You!\n-Warnasiri FoodCity"; // string | Text of the message. 320 chars max.
                    $to = "$customerNumber"; // string | Number to send the SMS. Better to use 9471XXXXXXX format.
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
                    
                    $getAdminNoDetails = "SELECT `admin_number` FROM `tbl_admin` WHERE `admin_id` = 1";
                    $noDetails = mysqli_fetch_assoc(mysqli_query($con,$getAdminNoDetails));
                    $adminNo = $noDetails['admin_number'];
                    
                    $api_instance = new NotifyLk\Api\SmsApi();
                    $user_id = "11897"; // string | API User ID - Can be found in your settings page.
                    $api_key = "xTbtIOAWowbMobSXYPwd"; // string | API Key - Can be found in your settings page.
                    $message = "New Order #ORD-$maxOrderID has been place - Warnasiri FoodCity"; // string | Text of the message. 320 chars max.
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
                    
                    
                    echo "Your Order Has Been Placed - Thankyou!";
                }
                else
                {
                    $deleteOrder = "DELETE FROM `tbl_sales_order` WHERE `s_orderId` = 'ORD-$maxOrderID'";
                    $deleteResultsOrder = mysqli_query($con,$deleteOrder);
                    if($deleteResultsOrder == 1)
                    {
                        $reUpdateCartStatus = "UPDATE `tbl_cart` SET `status`='0' WHERE `c_id` = '$cartId'";
                        $reUpdateCartResults = mysqli_query($con,$reUpdateCartStatus);
                        if($reUpdateCartResults == 1)
                        {
                            echo "Error occured while placing your order - Please Try Again!";
                        }
                    }
                }
                
            }
            else
            {
                $deleteOrder = "DELETE FROM `tbl_sales_order` WHERE `s_orderId` = 'ORD-$maxOrderID'";
                $deleteResultsOrder = mysqli_query($con,$deleteOrder);
                if($deleteResultsOrder == 1)
                {
                    $reUpdateCartStatus = "UPDATE `tbl_cart` SET `status`='0' WHERE `c_id` = '$cartId'";
                    $reUpdateCartResults = mysqli_query($con,$reUpdateCartStatus);
                    if($reUpdateCartResults == 1)
                    {
                        echo "Error occured while placing your order - Please Try Again!";
                    }
                }
                
            }
            
        }
        else
        {
            echo "Error occured while placing your order - Please Try Again!";
        }
        
    }
    else
    {
        echo "Some of the Items to be checkout are not available. Please remove those items which are not available.";
    }
    
}


?>