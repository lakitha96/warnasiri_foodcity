<?php

session_start();
include("db.php");

if(isset($_POST['verifyEmailRegistration']))
{


$email=$_POST['email'];
$pass=$_POST['password'];
$page = $_SESSION['atPage'];

$getMaxCusId = "SELECT MAX(CAST(SUBSTR(TRIM(cus_id),5) AS UNSIGNED)) AS cusId FROM tbl_customer WHERE cus_id RLIKE 'CUS'";
$maxCusIdResult = mysqli_query($con,$getMaxCusId);
$data = mysqli_fetch_assoc($maxCusIdResult);
$cusId = $data['cusId'];
if($cusId == null || $cusId =="")
{
    $customerId = 1;
}
else
{
    $customerId = $cusId + 1;
}
 
 
$query="INSERT INTO `tbl_customer`(`cus_id`, `cus_email`, `cus_password`) VALUES ('CUS-$customerId','$email','$pass')";

$result=mysqli_query($con,$query);
if($result==1)
{
    
        $_SESSION['cusEmailaddress']=$_POST['email'];
      $_SESSION['cusPassword']=$_POST['password'];
    $_SESSION['customerId'] = "CUS-$customerId";
    $customerId = $_SESSION['customerId'];
        
    if(isset($_SESSION["shopping_cart"]))
    {
        if(!empty($_SESSION["shopping_cart"]))
        {
           $cartIdMaxCurrentlyQuery = "SELECT MAX(CAST(SUBSTR(TRIM(c_id),5) AS UNSIGNED)) AS cartIdMaxCurrently FROM tbl_cart WHERE c_id RLIKE 'CRT'";
                $resultMaxCartIdData = mysqli_query($con,$cartIdMaxCurrentlyQuery);
                $resultsCartIdMax = mysqli_fetch_assoc($resultMaxCartIdData);
                $cartIdMax = $resultsCartIdMax['cartIdMaxCurrently'];
                
                if($cartIdMax == null || $cartIdMax=="")
                {
                    $newCartId = 1;
                    $cartId = "CRT-$newCartId";
                }
                else
                {
                    $newCartId = $cartIdMax + 1;
                    $cartId = "CRT-$newCartId";
                }
            
            foreach ($_SESSION["shopping_cart"] as $product){
                
                
                $product_id = $product['pro_id'];
                $product_qty = $product['pro_qty'];
                
                $checkProductExitsQuery = "SELECT COUNT(*) as countExits FROM `tbl_cart` WHERE `cus_id` = '$customerId' and product_id = '$product_id' and `status`='0'";
                $checkresults = mysqli_query($con,$checkProductExitsQuery);
                $checkResultRow = mysqli_fetch_assoc($checkresults);
                $countExits = $checkResultRow['countExits'];
                if($countExits >= 1)
                {
                    $selectProductdataExits = "SELECT quantity from tbl_cart WHERE cus_id = '$customerId' AND product_id = '$product_id' and status = '0'";
                    $resulProductExits = mysqli_query($con,$selectProductdataExits);
                    $rowProductExits = mysqli_fetch_assoc($resulProductExits);
                    $exitsProductQty = $rowProductExits['quantity'];
                    $updateProductQty = $product_qty + $exitsProductQty;
                    
                    if($updateProductQty > 10)
                    {
                        
                    }
                    else
                    {
                       $updateExitsQuery = "UPDATE `tbl_cart` SET `quantity`='$updateProductQty' WHERE cus_id = '$customerId' and product_id = '$product_id' and `status`='0'";
                    $updateExitsProductResult = mysqli_query($con,$updateExitsQuery);
                    if($updateExitsProductResult == 1)
                    {
                        
                    }
                    else
                    {
                        echo "
                        <script>
                            function goBack(){
                                alert('Error occurred while updating cart product!');

                            }

                            goBack();
                        </script>
        ";
                    } 
                    }
                    
                    
                    
                }
                else
                {
                    $addToCartQuery = "INSERT INTO `tbl_cart`(`c_id`, `product_id`, `cus_id`, `quantity`,  `status`) VALUES ('$cartId','$product_id','$customerId','$product_qty','0')";
                
                    $resultInserted = mysqli_query($con,$addToCartQuery);
                    if($resultInserted == 1)
                    {

                    }
                    else
                    {
                        echo "
                        <script>
                            function goBack(){
                                alert('Error occurred while updating cart!');

                            }

                            goBack();
                        </script>
        ";
                    }
                    
                }
                
                
            }
            
        }
        else
        {
            unset($_SESSION["shopping_cart"]);
        }
        
    }
    else
    {
        
    }
        
        
          
        
    
    
     echo "
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'</script>
         <script src='ttps://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js'</script>
    <script>  
     $(document).ready(function(){
     
     toastr.success(
                              '',
                              'Succesfully Registered',
                              {
                              positionClass: 'toast-top-center',
                                timeOut: 1000,
                                fadeOut: 1000,
                                onHidden: function () {
                                   window.location.replace('../$page');
                                  }
                                  
                              }
                            );
                            
     
     });
                    
                    </script>
    ";
    
   
}
else{
   
    
     echo "
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'</script>
         <script src='ttps://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js'</script>
    <script>  
     $(document).ready(function(){
     
                toastr.error(
                              '',
                              'Registration Unssuccefull Please Try Again!',
                              {
                              positionClass: 'toast-top-center',
                                timeOut: 1000,
                                fadeOut: 1000,
                                onHidden: function () {
                                    window.location.replace('../register.php');
                                  }
                                  
                              }
                            );
                            
     
     });
                    
                    </script>
    ";
    
    
     
}
    


}


?>
<html>
    <head>
         <link href=" https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
         <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    </head>
</html>