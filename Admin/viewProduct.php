<?php
session_start();
if(!isset($_SESSION['adminUsername']))
{
     echo "
                    <script>
                        function goBack(){
                            alert('Please Login!');
                          window.location.replace('auth-login.php');
                        }
                        
                        goBack();
                    </script>
    ";
}
else
{
include("assets/functions/function.php");
include("assets/functions/db.php");
 if(isset($_POST["product_id"]))  
 {
      $p_ID = $_POST["product_id"];
     
    
     
     $selectProductDetailsQuery = "SELECT * FROM `tbl_product` where pro_id = '$p_ID' ";
    $productDetailResult = mysqli_query($con,$selectProductDetailsQuery);
     while($productDetails=mysqli_fetch_array($productDetailResult))
     {
        
      
         $proImage = $productDetails['pro_image'];
     $proName = $productDetails['pro_name'];
     $proID = $productDetails['pro_id']; 
     $proDiscountStatus = $productDetails['pro_discount_status'];
     $proDiscountAmount = $productDetails['pro_discount_amount']; 
     $proprice = $productDetails['pro_display_price']; 
          $proStock = $productDetails['pro_available_stock'];
     $proAvailability = $productDetails['pro_available_status'];
     $proCatogoryId = $productDetails['cat_id'];
     $proDescription = $productDetails['pro_description'];
         
         $getCatNameQuery = "SELECT cat_name FROM `tbl_category` WHere cat_id = '$proCatogoryId'";
         
        $getCatDetails = mysqli_fetch_array(mysqli_query($con,$getCatNameQuery));
         $proCatogory = $getCatDetails['cat_name'];
     
     echo "
     
                <img class='productImageDetails' src='../img/item/$proImage' />
               <h3>$proName</h3><br>
                <p class='mb-2'>Product id: <span class='text-primary'>$proID</span></p>
     
     ";
     if($proDiscountStatus==1)
     {
         echo "
                <p class='mb-2'>Product Discount Status: <span class='text-primary'>Yes</span></p>
                <p class='mb-2'>Product Discount Amount: <span class='text-primary'>$proDiscountAmount %</span></p>
                <p class='mb-2'>Product Price: <span class='text-primary'>LKR $proprice</span></p>
                
         
         ";
     }
     else
     {
         echo "
                <p class='mb-2'>Product Discount Status: <span class='text-primary'>No</span></p>
                <p class='mb-2'>Product Price: <span class='text-primary'>LKR $proprice</span></p>
                
         
         ";
     }
     if($proAvailability == 1 && $proStock != 0)
     {
         echo "
                <p class='mb-2'>Product Availability: <span class='text-primary'>Now Available $proStock Item(s)</span></p>
                
         ";
     }
     else
     {
         echo "
                <p class='mb-2'>Product Availability: <span class='text-primary'>Not Available</span></p>
                
         ";
     }
     
     echo "
                <p class='mb-2'>Product Catogory: <span class='text-primary'>$proCatogory</span></p><br>
                <p class='mb-2'>Product Description: $proDescription</p>
     
     ";
         
         
     }
     
 }
}
?>
     
     