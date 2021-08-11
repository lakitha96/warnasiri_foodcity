<?php

include("assets/functions/function.php");
include("assets/functions/db.php");
 if(isset($_POST["order_Id"]))  
 {
  
     $order_Id = $_POST['order_Id'];
    
    $getOrdDetails = "SELECT `s_orderId`,`c_id`,`cus_fname`,`cus_lname`,`cus_tele`,`cus_nic`,`cus_email`,`cus_address`,`cus_city` FROM `tbl_sales_order` WHERE `s_orderId` = '$order_Id'";
    $resultOFOrder = mysqli_query($db,$getOrdDetails);
    $detailsOrder = mysqli_fetch_array($resultOFOrder);
    $orderID = $detailsOrder['s_orderId'];
    $orderCusFName = $detailsOrder['cus_fname'];
    $orderCusLName = $detailsOrder['cus_lname'];
    $orderCusTele = $detailsOrder['cus_tele'];
    $orderCusNic = $detailsOrder['cus_nic'];
    $orderCusEmail = $detailsOrder['cus_email'];
    $orderCusAddress = $detailsOrder['cus_address'];
    $orderCusCity = $detailsOrder['cus_city'];
    $cartID = $detailsOrder['c_id'];
     
     
    
    $getReturnOrderItems = "SELECT `s_returnId`, `product_id` FROM `tbl_sales_return` WHERE `s_orderId` = '$order_Id'";
    $allReturnItemInOrder = mysqli_query($db,$getReturnOrderItems);
    
    
    echo " 
     <p class='mb-2'>Order ID: <span class='text-primary'>$orderID</span></p>
        <p class='mb-2'>Customer Name: <span class='text-primary'>$orderCusFName $orderCusLName</span></p>                        
        <p class='mb-2'>Customer Contact No.: <span class='text-primary'>$orderCusTele</span></p> 
        <p class='mb-2'>Customer NIC No.: <span class='text-primary'>$orderCusNic</span></p> 
        <p class='mb-2'>Customer Email Addr.: <span class='text-primary'>$orderCusEmail</span></p> 
         <p class='mb-2'>Customer Address: <span class='text-primary'>$orderCusAddress</span></p> 
         <p class='mb-2'>Customer City: <span class='text-primary'>$orderCusCity</span></p>
        <div class='table-responsive'>
            <table class='table table-centered table-nowrap'>
                <thead>
                    <tr>
                        <th scope='col'>Return ID</th>
                        <th scope='col'>Product</th>
                        <th scope='col'>Product Name</th>

                        <th scope='col' style='text-align:center;'>Qty.</th>
                    </tr>
                </thead>
                <tbody >
    
    
    ";
    
    
    while($returnOrderRow = mysqli_fetch_array($allReturnItemInOrder))
    {
        $returnID = $returnOrderRow['s_returnId'];
        $returnProId = $returnOrderRow['product_id'];
        
        $getCartQuantity = "SELECT `quantity` FROM `tbl_cart` WHERE `c_id` = '$cartID' and `product_id` = '$returnProId'";
        $cartQtyData = mysqli_query($db,$getCartQuantity);
        $quatityDetails = mysqli_fetch_assoc($cartQtyData);
        $proQty = $quatityDetails['quantity'];
        
        $getProductData = "SELECT `pro_name`,`pro_image` FROM `tbl_product` WHERE `pro_id`='$returnProId'";
        $productDataResults = mysqli_query($db,$getProductData);
        $fetchedProductDetails = mysqli_fetch_array($productDataResults);
        $productImage = $fetchedProductDetails['pro_image'];
        $productName = $fetchedProductDetails['pro_name'];
        echo "
                 
        
        
                <tr>
                    <td style='vertical-align: middle;'>
                        <div>
                            <h6 class='text-truncate'>$returnID</h6>
                            
                        </div>
                    </td>
                    <th scope='row'>
                        <div>
                            <img src='../img/item/$productImage' alt='' class='avatar-sm'>
                        </div>
                    </th>
                    <td style='vertical-align: middle;'>
                        <div>
                            <h6 class='text-truncate'>$productName</h6>
                            
                        </div>
                    </td>
                    <td style='vertical-align: middle;text-align:center;'>
                        <div>
                            <h6 class='text-truncate'>$proQty</h6>
                            
                        </div>
                    </td>
                    
                </tr>
        
        ";
        
    }
    echo "
            
            </tbody>
       </table>
    
    ";
     
     
 }


?>