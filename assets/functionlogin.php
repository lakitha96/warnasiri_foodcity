<?php


session_start();

include("db.php");

if(isset($_POST['btnloginUser']))
{


$email=$_POST['email'];
$pass=$_POST['password'];
$page = $_SESSION['atPage'];

$query="SELECT cus_id,cus_email,cus_password FROM `tbl_customer` WHERE cus_email='$email' AND cus_password='$pass'";
$results = mysqli_query($con,$query);
$no_of_rows = mysqli_num_rows($results);
if($no_of_rows == 1)
{
    $row_details = mysqli_fetch_array($results);
    $customerId = $row_details['cus_id'];
    $email = $row_details['cus_email'];
    $pass = $row_details['cus_password'];
    
    $_SESSION['cusEmailaddress']=$email;
      $_SESSION['cusPassword']=$pass;
        $_SESSION['customerId'] = $customerId;
    
    if(isset($_SESSION["shopping_cart"]))
    {
        if(!empty($_SESSION["shopping_cart"]))
        {
            $selectCartId = "SELECT `c_id` FROM `tbl_cart` WHERE `cus_id` = '$customerId' and `status`='0'";
            $cartResult = mysqli_query($con,$selectCartId);
            $cartIdDetails = mysqli_fetch_assoc($cartResult);
            $cartId = $cartIdDetails['c_id'];
        
            if($cartId == null || $cartId == "")
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
                              'Successfully Logged',
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
    
    
    
    
    
    
    
    // 
    
}
else{
    
    echo "
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'</script>
         <script src='ttps://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js'</script>
    <script>  
     $(document).ready(function(){
     
                toastr.error(
                              '',
                              'Make sure that both email and password is correct!',
                              {
                              positionClass: 'toast-top-center',
                                timeOut: 1000,
                                fadeOut: 1000,
                                onHidden: function () {
                                    window.location.replace('../login.php');
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