<?php
include('pdf.php');
require_once('assets/Notify/notify-php-master/autoload.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require 'vendor/autoload.php';
include("assets/functions/function.php");
include("assets/functions/db.php");
 if(isset($_POST["return_Order_Id"]))  
 {
    $returnOrderStatus = $_POST['returnOrdStatus'];
     $return_Order_Id = $_POST['return_Order_Id'];
     $updateStatusOrder = "UPDATE `tbl_sales_return` SET `return_status`='$returnOrderStatus' WHERE `s_orderId` = '$return_Order_Id'";
     $results = mysqli_query($con,$updateStatusOrder);
     
     if($returnOrderStatus == 2)
     {
         if($results == 1)
         { //send order
              
           echo "Return order has been accepted";
            
         }
         else
         {
             echo "Somthing went wrong please try again";
         } 
     }
     else if($returnOrderStatus == 3)
     {
          if($results == 1)
         {
             echo "Return order status changes to deliverd";
         }
         else
         {
             echo "Somthing went wrong please try again";
         } 
     }
     else if($returnOrderStatus == 4)
     {
         if($results == 1)
         {
             
            echo "Return order has been Completed";
             
             
         }
         else
         {
             echo "Somthing went wrong please try again";
         } 
     }
     else if($returnOrderStatus == 5)
     {
         
         if($results == 1)
         { //update payment table
             
                 echo "Return order has been declined";
             
              
         }
         else
         {
             echo "Somthing went wrong please try again";
         }
     }
     
     
     
     
     
     
 }




?>