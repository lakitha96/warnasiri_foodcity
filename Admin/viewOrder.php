<?php

include("assets/functions/function.php");
include("assets/functions/db.php");
 if(isset($_POST["cart_Id"]))  
 {
  
     $cart_Id = $_POST['cart_Id'];
     

    $totAmount = 0;
    $getAllProductsInCart = "SELECT * FROM `tbl_cart` WHERE `c_id` = '$cart_Id'";
    $allProductResults = mysqli_query($db,$getAllProductsInCart);
    
    $getOrdDetails = "SELECT `s_orderId`,`cus_fname`,`cus_lname`,`cus_tele`,`cus_nic`,`cus_email`,`cus_address`,`cus_city` FROM `tbl_sales_order` WHERE `c_id` = '$cart_Id'";
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
                        <th scope='col'>Product</th>
                        <th scope='col'>Product Name</th>

                        <th scope='col' style='text-align:center;'>Total</th>
                    </tr>
                </thead>
                <tbody >
    
    
    ";
    
    
    while($ProductRow = mysqli_fetch_array($allProductResults))
    {
        $cartProId = $ProductRow['product_id'];
        $cartProQty = $ProductRow['quantity'];
        $cartProTotal =  $ProductRow['total'];
        $getOtherProductDetails = "SELECT * FROM `tbl_product` WHERE `pro_id` = '$cartProId'";
        $otherDetailsResults = mysqli_query($db,$getOtherProductDetails);
        $fetchOtherDetails = mysqli_fetch_array($otherDetailsResults);
        $productImage = $fetchOtherDetails['pro_image'];
        $productName = $fetchOtherDetails['pro_name'];
        $unitPrice = $cartProTotal / $cartProQty;
        
        
        
        echo "
                 
        
        
                <tr>
                    <th scope='row'>
                        <div>
                            <img src='../img/item/$productImage' alt='' class='avatar-sm'>
                        </div>
                    </th>
                    <td>
                        <div>
                            <h6 class='text-truncate'>$productName</h6>
                            <p class='text-muted mb-0'>LKR $unitPrice x $cartProQty</p>
                        </div>
                    </td>
                    <td style='text-align:right;'><h6 class='text-truncate'>LKR $cartProTotal</h6></td>
                </tr>
        
        ";
        $totAmount = $totAmount + $cartProTotal;
    }
    echo "
            <tr>
                <td colspan='2'>
                    <h5 class='m-0 text-right subTot'>Sub Total:</h5>
                </td>
                <td style='text-align:right;'>
                <h5 class='m-0 subTot'>LKR $totAmount</h5>
                    
                </td>
            </tr>
            
            <tr>
                <td colspan='2'>
                    <h5 class='m-0 text-right subTot'>Total:</h5>
                </td>
                <td style='text-align:right;'>
                <h5 class='m-0 subTot'>LKR $totAmount</h5>
                    
                </td>
            </tr>
            </tbody>
       </table>
    
    ";
      

     
     
 }


?>