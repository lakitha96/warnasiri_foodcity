<?php
session_start();
include("assets/functions.php");
include("assets/db.php");

if(isset($_SESSION['customerId']))
{
    $cusId = $_SESSION['customerId'];
    $notAvailbleProducts = 0;
    $checkForNotAvailableProducts = "SELECT product_id,quantity FROM `tbl_cart` WHERE cus_id = '$cusId' and status = '0'";
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
            
        }
        else
        {
            $notAvailbleProducts = $notAvailbleProducts + 1;
        }
        
    }
    if($notAvailbleProducts == 0)
    {
        echo "ok";
        
    }
    else
    {
        echo "Some of the Items to be checkout are not available. Please remove those items which are not available.";
    }
    
    
    
    
}
else if(isset($_SESSION["shopping_cart"]) && !isset($_SESSION["customerId"]))
    {
        if(!empty($_SESSION["shopping_cart"]))
        {
            $notAvailbleProducts = 0;
            foreach ($_SESSION["shopping_cart"] as $product){
                $product_id = $product['pro_id'];
                $product_qty = $product['pro_qty'];
                
                $checkForAvailablilityQuery = "SELECT `pro_available_stock`,`pro_available_status`,`pro_display_price`,`pro_discount_status`,`pro_discount_amount` FROM `tbl_product` WHERE pro_id = '$product_id'";
                $availResultsData = mysqli_query($con,$checkForAvailablilityQuery);
                $availableDetails = mysqli_fetch_array($availResultsData);
                $stockCount = $availableDetails['pro_available_stock'];
                $availbleStatus = $availableDetails['pro_available_status'];
                $discountStatus = $availableDetails['pro_discount_status'];
                $discountAmount = $availableDetails['pro_discount_amount'];
                $proPrice = $availableDetails['pro_display_price'];

                if($availbleStatus == 1 && $stockCount >= $product_qty)
                {

                }
                else
                {
                    $notAvailbleProducts = $notAvailbleProducts + 1;
                }
                
                
            }
            if($notAvailbleProducts == 0)
            {
                echo "yes";
            }
            else
            {
                echo "Some of the Items to be checkout are not available. Please remove those items which are not available.";
            }
            
            
            
        }
        else
        {
            echo "Please add some product to checkout - Thankyou!";
        }
}


?>