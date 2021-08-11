<?php
session_start();
include("assets/functions.php");
include("assets/db.php");

if(isset($_SESSION['customerId']))
{
   
    $cusId = $_SESSION['customerId'];
    
}





if(isset($_POST["order_id"]))  
{
    $orderId = $_POST['order_id'];
    
    $deleteQuery = "DELETE FROM `tbl_sales_return` WHERE `s_orderId` = '$orderId'";
    $deleteResults = mysqli_query($con,$deleteQuery);
    if($deleteResults == 1)
    {
        echo "Return order has been canceled";
    }
    else
    {
        echo "Something went wrong - Please Try Again!";
    }
}


?>