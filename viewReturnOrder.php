<?php
session_start();
include("assets/functions.php");
include("assets/db.php");

if(isset($_SESSION['customerId']))
{
    $cusId = $_SESSION['customerId'];
}



if(isset($_POST["return_OrderId"]))  
{
    $returnOrderID = $_POST['return_OrderId'];
    
   getReturnDetails($returnOrderID);
    
}

?>