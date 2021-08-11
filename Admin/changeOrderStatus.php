<?php
include('pdf.php');
require_once('assets/Notify/notify-php-master/autoload.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require 'vendor/autoload.php';
include("assets/functions/function.php");
include("assets/functions/db.php");
 if(isset($_POST["order_id"]))  
 {
    $orderStatus = $_POST['ordStatus'];
     $order_Id = $_POST['order_id'];
     $updateStatusOrder = "UPDATE `tbl_sales_order` SET `order_status`='$orderStatus' WHERE s_orderId = '$order_Id'";
     $results = mysqli_query($con,$updateStatusOrder);
     
     if($orderStatus == 2)
     {
         if($results == 1)
         { //send order
              
             $getOrdedrDetails = "SELECT `c_id`,`cus_email` FROM `tbl_sales_order` WHERE `s_orderId` = '$order_Id'";
             $orderDetailsRow = mysqli_fetch_array(mysqli_query($con,$getOrdedrDetails));
             
             $cartId = $orderDetailsRow['c_id'];
             $cusEmail = $orderDetailsRow['cus_email'];
             
             $file_name = $order_Id . '.pdf';
             $html_code = '<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">';
             $html_code .= printBillPdf($cartId);
             $pdf = new Pdf();
             $pdf->load_html($html_code);
             $pdf->render();
             $file = $pdf->output();
             file_put_contents("assets/OrderBills/$file_name",$file);
             
             $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->SMTPDebug = 0;
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->SMTPAuth = true;
                $mail->Username = 'warnasirifoodcity@gmail.com';
                $mail->Password = 'warnasiri@2021';
                $mail->setFrom('warnasirifoodcity@gmail.com', 'Warnasiri FoodCity');
                $mail->addReplyTo('warnasirifoodcity@gmail.com', 'Warnasiri Foodcity');
                $mail->addAddress($cusEmail);
                $mail->AddAttachment("assets/OrderBills/$file_name");
                $mail->Subject = "Invoice for your order Id - $order_Id";
                 $mail->Body = 'Your Order has been Accepted - Warnasiri FoodCity';
             
                 if (!$mail->send()) 
                {
                    //echo 'Mailer Error: '. $mail->ErrorInfo;
                    echo "Somthing went wrong please try again";
                } 
                else 
                {
                    echo "Order has been accepted";
                }
             
            
         }
         else
         {
             echo "Somthing went wrong please try again";
         } 
     }
     else if($orderStatus == 3)
     {
          if($results == 1)
         {
             echo "Order status changes to deliverd";
         }
         else
         {
             echo "Somthing went wrong please try again";
         } 
     }
     else if($orderStatus == 4)
     {
         if($results == 1)
         {
             
             $updatePaymentStatus = "UPDATE `tbl_payment` SET `pay_status`='Paid' WHERE `s_orderId` = '$order_Id'";
             $updatePaymentResults = mysqli_query($con,$updatePaymentStatus);
             if($updatePaymentResults == 1)
             {
                 $getOrdedrDetails = "SELECT `cus_tele` FROM `tbl_sales_order` WHERE `s_orderId` = '$order_Id'";
                 $orderDetailsRow = mysqli_fetch_array(mysqli_query($con,$getOrdedrDetails));

                 $cusTele = $orderDetailsRow['cus_tele'];
                 
                  $api_instance = new NotifyLk\Api\SmsApi();
                $user_id = "11917"; // string | API User ID - Can be found in your settings page.
                $api_key = "OynVdowsrbmkpc5tkLKj"; // string | API Key - Can be found in your settings page.
                $message = "Your order has been completed - Thankyou for using Warnasiri FoodCity"; // string | Text of the message. 320 chars max.
                $to = "$cusTele"; // string | Number to send the SMS. Better to use 9471XXXXXXX format.
                $sender_id = "NotifyDEMO";
                $contact_fname = ""; // string | Contact First Name - This will be used while saving the phone number in your Notify contacts.
                $contact_lname = ""; // string | Contact Last Name - This will be used while saving the phone number in your Notify contacts.
                $contact_email = ""; // string | Contact Email Address - This will be used while saving the phone number in your Notify contacts.
                $contact_address = ""; // string | Contact Physical Address - This will be used while saving the phone number in your Notify contacts.
                $contact_group = 0; // int | A group ID to associate the saving contact with



            try {
                $api_instance->sendSMS($user_id, $api_key, $message, $to, $sender_id, $contact_fname, $contact_lname, $contact_email, $contact_address, $contact_group);
               // echo "$random_no";
            } catch (Exception $e){
                //echo "123";
               // echo 'Exception when calling SmsApi->sendSMS: ', $e->getMessage(), PHP_EOL;
            }
                 
                 
                 echo "Order has been Completed";
             }
             else
             {
                 echo "Somthing went wrong please try again";
             }
             
             
         }
         else
         {
             echo "Somthing went wrong please try again";
         } 
     }
     else if($orderStatus == 5)
     {
         
         if($results == 1)
         { //update payment table
             $updatePaymentStatus = "UPDATE `tbl_payment` SET `pay_status`='Canceled' WHERE `s_orderId` = '$order_Id'";
             $updatePaymentResults = mysqli_query($con,$updatePaymentStatus);
             if($updatePaymentResults == 1)
             {
                 echo "Order has been declined";
             }
             else
             {
                 echo "Somthing went wrong please try again";
             }
              
         }
         else
         {
             echo "Somthing went wrong please try again";
         }
     }
     
     
     
     
     
     
 }




?>