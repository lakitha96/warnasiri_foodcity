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
  
    
$pro_id = $_POST['product_id'];   
$query = "SELECT * FROM `tbl_product` WHERE `pro_id`='$pro_id'";

$result = mysqli_query($con,$query);
$row = mysqli_fetch_array($result); 
$product_Id = $row['pro_id'];
$availabilityStatus = $row['pro_available_status'];
$proQty = 1;

    
    
if(isset($_SESSION['cusEmailaddress']))
{
    $checkProductExits = "SELECT COUNT(*) as countProductExits FROM `tbl_cart` WHERE cus_id = '$cusId' and product_id = '$product_Id' and status='0'";
    $checkExitsResults = mysqli_query($db,$checkProductExits);
    $checkResultRow = mysqli_fetch_assoc($checkExitsResults);
    $productExits = $checkResultRow['countProductExits'];
    
    if($productExits >= 1)
    {
         echo "Product is already added to your cart!";
    }
    else
    {
            $selectCartId = "SELECT `c_id` FROM `tbl_cart` WHERE `cus_id` = '$cusId' and `status`='0'";
            $cartResult = mysqli_query($db,$selectCartId);
            $cartIdDetails = mysqli_fetch_assoc($cartResult);
            $cartId = $cartIdDetails['c_id'];
        
            if($cartId == null || $cartId == "")
            {
                $cartIdMaxCurrentlyQuery = "SELECT MAX(CAST(SUBSTR(TRIM(c_id),5) AS UNSIGNED)) AS cartIdMaxCurrently FROM tbl_cart WHERE c_id RLIKE 'CRT'";
                $resultMaxCartIdData = mysqli_query($db,$cartIdMaxCurrentlyQuery);
                $resultsCartIdMax = mysqli_fetch_assoc($resultMaxCartIdData);
                $cartIdMax = $resultsCartIdMax['cartIdMaxCurrently'];
                $newCartId="";
                if($cartIdMax == null || $cartIdMax=="")
                {
                    $newCartId = 1;
                }
                else
                {
                    $newCartId = $cartIdMax + 1;
                }
                
                $addToCartQuery = "INSERT INTO `tbl_cart`(`c_id`, `product_id`, `cus_id`, `quantity`,  `status`) VALUES ('CRT-$newCartId','$product_Id','$cusId','$proQty','0')";
                
                $resultInserted = mysqli_query($db,$addToCartQuery);
                if($resultInserted == 1)
                {
                    echo "Product added to your cart!";
                }
                else
                {
                    echo "Product canno't added to your cart! - Error Occured";
                }
                
                
            }
            else
            {
                $addToCartQuery = "INSERT INTO `tbl_cart`(`c_id`, `product_id`, `cus_id`, `quantity`,  `status`) VALUES ('$cartId','$product_Id','$cusId','$proQty','0')";
                
                $resultInserted = mysqli_query($db,$addToCartQuery);
                if($resultInserted == 1)
                {
                    echo "Product added to your cart!";
                }
                else
                {
                    echo "Product canno't added to your cart! - Error Occured";
                }
            }
            
    }
    //window.history.back();
}
else if(!isset($_SESSION['cusEmailaddress']))
{
$cartArray = array(
 $pro_id   =>array(
        'pro_id'=>$pro_id,
        'pro_qty'=>$proQty
 )
);

if(empty($_SESSION["shopping_cart"])) 
{
	$_SESSION["shopping_cart"] = $cartArray;
	//$status = "<div class='box'>Product is added to your cart!</div>";
    echo "Product added to your cart!";
    
}
else
{
	$array_keys = array_keys($_SESSION["shopping_cart"]);
	if(in_array($pro_id,$array_keys)) {
        echo "Product is already added to your cart!";
        
		//$status = "<div class='box' style='color:red;'>
		//Product is already added to your cart!</div>";	
	}
    else
    {
	   $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
	   //$status = "<div class='box'>Product is added to your cart!</div>";
        echo "Product added to your cart!";
	}

	}
    
}
}


?>