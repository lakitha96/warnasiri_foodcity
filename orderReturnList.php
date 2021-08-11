<?php
session_start();
include("assets/functions.php");
include("assets/db.php");

if(isset($_SESSION['customerId']))
{
   
    $cusId = $_SESSION['customerId'];
    
}


if(isset($_POST["cart_id"]))  
{
    
    $cartID = $_POST['cart_id'];
    
  
    getOrderReturnDetails($cartID);
    
}

?>