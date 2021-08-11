<?php

session_start();
include("assets/db.php");
include("assets/functions.php");
if(isset($_SESSION['customerId']))
{
    $cusId = $_SESSION['customerId'];
}
if(isset($_POST["product_id"]))  
{
    
    if(!empty($_SESSION["shopping_cart"]) && !isset($_SESSION['customerId'])) {
    
    $product  = $_POST["product_id"];
    
    
	foreach($_SESSION["shopping_cart"] as $key => $value) {
		if($product == $key){
		 unset($_SESSION["shopping_cart"]["$key"]);
		echo "Product removed from your cart!";
		
		}
        else
        { 
           
        }
		if(empty($_SESSION["shopping_cart"]))
		unset($_SESSION["shopping_cart"]);
			}		
		}
    else if(isset($_SESSION['customerId']))
    {
        $product  = $_POST["product_id"];
        $deleteProductQuery = "DELETE FROM `tbl_cart` WHERE `product_id`='$product' and cus_id='$cusId' and status = '0'";
        $deleteResult = mysqli_query($db,$deleteProductQuery);
        if($deleteResult == 1)
        {
            echo "Product removed from your cart!";
		
        }
        else
        {
            
        }
    }

}



?>