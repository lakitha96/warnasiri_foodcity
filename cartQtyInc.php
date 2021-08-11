<?php
session_start();
include("assets/functions.php");
include("assets/db.php");

if(isset($_SESSION['customerId']))
{
    $cusId = $_SESSION['customerId'];
}



if(isset($_POST["product_id"]))  
{
    
    
    if(!empty($_SESSION["shopping_cart"]) && !isset($_SESSION['customerId'])) {
    
    
    $qty = $_POST['quantChange'];
    $qty = $qty + 1;
    
  foreach($_SESSION["shopping_cart"] as &$pro_id){
    if($pro_id['pro_id'] === $_POST["product_id"]){
        
        $pro_id['pro_qty'] = $qty;
        
       
        break; // Stop the loop after we've found the product
    }
      
}
    }
    else if(isset($_SESSION['customerId']))
    {
       
        $qty = $_POST['quantChange'];
        $qty = $qty + 1;
        $pro_ID = $_POST["product_id"];
        
        
        $updateQtyIncQuery = "UPDATE `tbl_cart` SET `quantity`='$qty' WHERE cus_id = '$cusId' and product_id = '$pro_ID' and status = '0'";
                    $updateIncResult = mysqli_query($db,$updateQtyIncQuery);
                    if($updateIncResult == 1)
                    {
                       
                    }
        
    } 
  	
}



?>