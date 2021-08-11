<?php
session_start();
$_SESSION['atPage']="cart.php";
include("assets/functions.php");
include("assets/db.php");

if(isset($_SESSION['customerId']))
{
    $cusId = $_SESSION['customerId'];
}
/*
if(!empty($_SESSION["shopping_cart"])) {
 print_r($_SESSION["shopping_cart"]);
}*/


/*
//pro_id,quantChange,btnQtyInc,btnQtyDec
if(isset($_POST['btnQtyInc']))
{
    $qty = $_POST['quantChange'];
    $qty = $qty + 1;
}
if(isset($_POST['btnQtyDec']))
{
    $qty = $_POST['quantChange'];
    $qty = $qty - 1;
}
pro_price,totAmount
  */                          







?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     
      <title>Warnasiri FoodCity</title>
      <!-- Favicon Icon -->
      <link rel="icon" type="image/png" href="img/WarnasiriLogo.png">
      <!-- Bootstrap core CSS -->
      <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <!-- Material Design Icons -->
      <link href="vendor/icons/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />
      <!-- Select2 CSS -->
      <link href="vendor/select2/css/select2-bootstrap.css" />
      <link href="vendor/select2/css/select2.min.css" rel="stylesheet" />
      <!-- Custom styles -->
      <link href="css/style.css" rel="stylesheet">
      <!-- Owl Carousel -->
      <link rel="stylesheet" href="vendor/owl-carousel/owl.carousel.css">
      <link rel="stylesheet" href="vendor/owl-carousel/owl.theme.css">
      <link href=" https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
   </head>
   <body>
      <div class="navbar-top bg-success pt-2 pb-2">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-12 text-center">
                  <a href="shop.php" class="mb-0 text-white">
                  Free delivery for orders above <strong><span class="text-light">LKR 5000</span></strong> in Galle area. <br>
                Delivery service operates only in and around <strong><span>Galle area.</span></strong>
                  </a>
               </div>
            </div>
         </div>
      </div>
      <nav class="navbar navbar-light navbar-expand-lg bg-dark bg-faded daya-menu">
         <div class="container-fluid">
            <a class="navbar-brand" href="index.php"> <img src="img/WarnasiriIconLogo.jpeg"> </a>
			<a class="location-top" href="#"><i class="mdi mdi-map-marker-circle" aria-hidden="true"></i> Sri Lanka</a>
            <button class="navbar-toggler navbar-toggler-white" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse" id="navbarNavDropdown">
               <div class="navbar-nav mr-auto mt-2 mt-lg-0 margin-auto top-categories-search-main">
                  <div class="top-categories-search">
                     <form class="input-group" method="get" action="shop.php">
                        <span class="input-group-btn categories-dropdown">
                           <select class="form-control-select">
                              <option selected="selected">All Catogories</option>
                              
                           </select>
                        </span>
                        <input class="form-control" name="searchfield" placeholder="Search products.." aria-label="Search products" type="text" >
                        <span class="input-group-btn">
                        <button class="btn btn-secondary" type="submit" > Search</button>
                        </span>
                     </form>
                  </div>
               </div>
               <div class="my-2 my-lg-0">
                  <ul class="list-inline main-nav-right">
                    
                    <?php
                      if(isset($_SESSION['cusEmailaddress']))
                      {
                          echo "
                         <li class='list-inline-item log-btn'>
                        <a href='my-profile.php'  class='btn btn-link'><i class='mdi mdi-account-circle' style='font-size: 23px;'></i> My Account</a>
                     </li>
                         
                         ";
                      }
                      else
                      {
                         echo "
                         <li class='list-inline-item log-btn'>
                        <a href='login.php'  class='btn btn-link'><i class='mdi mdi-account-circle' style='font-size: 23px;'></i> Login</a>
                     </li>
                         
                         "; 
                      }
                      ?>
                     
                     <li id="cartArea" class="list-inline-item cart-btn">
                       <?php
                         
                         
                       if(isset($_SESSION['cusEmailaddress']))
                       {
                           
                           $cartCountQuery = "SELECT COUNT(*)AS cartCount FROM `tbl_cart` WHERE cus_id = '$cusId' and status='0'";
                           $countResults = mysqli_query($con,$cartCountQuery);
                           $resultRow = mysqli_fetch_assoc($countResults);
                           $cartCount = $resultRow['cartCount'];
                           
                           echo "
                                 <a href='cart.php' data-toggle='offcanvas' class='btn btn-link border-none'><i class='mdi mdi-cart'></i> My Cart <small class='cart-value'>$cartCount</small></a>
                                 ";
                           
                       }
                        else if(!isset($_SESSION['cusEmailaddress']))
                       {
                             if(!empty($_SESSION["shopping_cart"])) {
                                 $cart_count = count(array_keys($_SESSION["shopping_cart"]));  
                                 echo "
                                 <a href='cart.php' data-toggle='offcanvas' class='btn btn-link border-none'><i class='mdi mdi-cart'></i> My Cart <small class='cart-value'>$cart_count</small></a>
                                 ";
                                 
                             }
                            else
                            {
                                echo "
                                 <a href='cart.php' data-toggle='offcanvas' class='btn btn-link border-none'><i class='mdi mdi-cart'></i> My Cart <small class='cart-value'>0</small></a>
                                 ";
                            }
                       }
                       
                       ?>
                       
                        
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </nav>
      <nav class="navbar navbar-expand-lg navbar-light daya-menu-2 pad-none-mobile">
         <?php include("assets/mainMenu.php"); ?> 
      </nav>
	  <section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <a href="#"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span class="mdi mdi-chevron-right"></span> <a href="#">Cart</a>
               </div>
            </div>
         </div>
      </section>
      <section class="cart-page section-padding">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <?php
                        if(isset($_SESSION["shopping_cart"]) && !isset($_SESSION['cusEmailaddress'])){
                            
                                $totalAmount = 0;
                                //$_SESSION['total_price'] = 0;
                            
                            
                        ?>
                  <div class="card card-body cart-table">
                   
                     <div class="table-responsive">
                       	
                        <table class="table cart_summary">
                           <thead>
                              <tr>
                                 <th class="cart_product">Product</th>
                                 <th style="text-align:center;">Name</th>
                                 <th style="text-align:center;">Availability</th>
                                 <th style="text-align:center;">Unit price</th>
                                 <th style="text-align:center;">Qty</th>
                                 <th style="text-align:center;">Total</th>
                                 <th style="text-align:center;" class="action"><i class="mdi mdi-delete-forever"></i></th>
                              </tr>
                           </thead>
                           <tbody>
                             <?php		
                                foreach ($_SESSION["shopping_cart"] as $product){
                                
                                    
                                    $product_id = $product['pro_id'];
                                    $checkAvail = "select * from tbl_product where pro_id='$product_id'";
                                    $res = mysqli_query($con,$checkAvail);
                                    $row = mysqli_fetch_array($res);
                                    $avil_Status = $row['pro_available_status'];
                                    $discount_Status = $row['pro_discount_status'];
                                    $discount_Amount = $row['pro_discount_amount'];
                                    $pro_Image = $row['pro_image'];
                                    $pro_Name = $row['pro_name'];
                                    $pro_Price = $row['pro_display_price'];
                                    $avai_Stock = $row['pro_available_stock'];
                               
                               ?>
                              <tr>
                                
                                 <td class="cart_product"><a href="#"><img class="img-fluid img-cart" src="img/item/<?= $pro_Image ?>" alt=""></a></td>
                                 <td class="cart_description">
                                    <h5 class="product-name"><a href="#"><?= $pro_Name ?> </a></h5>
                                    <?php if($avil_Status == 1 && $avai_Stock !=0){ ?>
                                    <h6><strong><span class="mdi mdi-approval"></span> Now Available </strong><span style="color:orange; font-size:14px;"><?= $avai_Stock ?> Item(s)</span></h6>
                                    <?php } else { ?>
                                    
                                    <h6><strong><span class="mdi mdi-approval"></span> Not Available</strong></h6>
                                    <?php } ?>
                                 </td>
                                 <?php if($avil_Status == 1 && $avai_Stock !=0){ ?>
                                     <td style="text-align:center;" class="availability in-stock"><span class="badge badge-success">In stock</span></td>
                                 <?php } else { ?>
                                     <td style="text-align:center;" class="availability in-stock"><span class="badge badge-danger">Stock Out</span></td>
                                 <?php } ?>
                                 
                                 <?php if($discount_Status==1){
                                        $singleProductPrice = $pro_Price - (($pro_Price * $discount_Amount)/100);
                                ?>
                                 <td style="text-align:center;" class="price"><span><?= $singleProductPrice ?></span></td>
                                 <?php }else{
                                  
                                  $singleProductPrice = $pro_Price ;
                                  ?>
                                    <td style="text-align:center;" class="price"><span><?= $singleProductPrice ?></span></td>
                                <?php } ?>
                                 
                                 <td class="qty">
                                   <form action="" method="post">
                                    <div class="input-group">
                                      <!--<form action="" method="post">-->
                                      <input type="text" name="pro_id" value="<?= $product['pro_id']; ?>" hidden >
                                      <?php if($product['pro_qty'] > 1){  ?>
                                      <span class="input-group-btn"><button value="<?= $product['pro_qty'] ?>" name="btnQtyDec" class="btn qtyChangeBtn btn-theme-round btn-number btnCartQtyDec" type="button" id="<?= $product['pro_id']; ?>">-</button></span>
                                      <?php }else { ?>
                                      <span class="input-group-btn"><button value="<?= $product['pro_qty'] ?>" name="btnQtyDec" disabled="disabled" class="btn btn-theme-round qtyChangeBtn btn-number btnCartQtyDec" type="button" id="<?= $product['pro_id']; ?>">-</button></span>
                                      
                                      <?php } ?>
                                      
                                        
                                       <input onkeydown="return false" type="text" max="10" min="1" value="<?= $product['pro_qty'] ?>" class="form-control border-form-control qtyTextCart form-control-sm input-number" name="quantChange">
                                       
                                       <?php if($product['pro_qty'] < 10){  ?>
                                       <span class="input-group-btn"><button value="<?= $product['pro_qty'] ?>" name="btnQtyInc" id="<?= $product['pro_id']; ?>" class="btn qtyChangeBtn btn-theme-round btn-number btnCartQtyInc" type="button">+</button>
                                       </span>
                                       <?php }else { ?>
                                       <span class="input-group-btn"><button value="<?= $product['pro_qty'] ?>" name="btnQtyInc" id="<?= $product['pro_id']; ?>" disabled class="btn qtyChangeBtn btn-theme-round btn-number btnCartQtyInc" type="button">+</button>
                                       </span>
                                       
                                       <?php } ?>
                                       <!--</form>--> 
                                    </div>
                                    </form>
                                 </td>
                                 <?php $totOfProduct = $singleProductPrice * $product['pro_qty']; ?>
                                 <td style="text-align:center;" class="price"><span><?= $totOfProduct ?></span></td>
                                 
                                 <td style="text-align:center;" class="action">
                                   <form method="post" action="">
                                   <input type='hidden' name='product_id' value="<?= $product['pro_id']; ?>" />
                                    <button id="<?= $product['pro_id']; ?>" name="btnRemove" type="button" class="btn btn-sm btn-danger btnCartProductRemove" data-original-title="Remove" href="#" title="" data-placement="top" data-toggle="tooltip"><i class="mdi mdi-close-circle-outline"></i></button>
                                    </form>
                                 </td>
                              </tr>
                              <?php
                                //$total_price += ($product["price"]*$product["quantity"]);
                                 $totalAmount =  $totalAmount + $totOfProduct;
                                }
                                ?>
                              
                           </tbody>
                           <tfoot>
                              
                           </tfoot>
                        </table>
                     </div>
                     <div class="card-footer cart-sidebar-footer">
                        <div class="cart-store-details">
                           <p>Sub Total <strong class="float-right">Rs. <?=  $totalAmount ?></strong></p>
                           <p>Delivery Charges <strong class="float-right text-danger">Delivery charges will vary acccording to delivery location</strong></p>
                        </div>
                        
                     </div>
                     
                     
                     <button class="btn btn-secondary btn-lg btn-block text-left proceedToCheckOut" type="button"><span class="float-left"><i class="mdi mdi-cart-outline"></i> Proceed to Checkout </span><span class="float-right"><strong>Rs. <?=  $totalAmount ?></strong> <span class="mdi mdi-chevron-right"></span></span></button>
                  </div>
                  
                  
                  <?php
                      }
                      else if(!isset($_SESSION['cusEmailaddress']))
                        {
                            echo "<h3>Your cart is empty!</h3>";
                        }
                   
                   else if(isset($_SESSION['cusEmailaddress'])){
                   
                      $countAllRecords = "SELECT Count(*) as allRecords FROM `tbl_cart` WHERE cus_id = '$cusId' and status='0'";
                      $resultRecords = mysqli_query($db,$countAllRecords);
                      $rowDataResults = mysqli_fetch_assoc($resultRecords);
                       $noOfRecords = $rowDataResults['allRecords'];
                       if($noOfRecords >= 1)
                       {
                       
                   
                   
                   ?>
                   
                    <div class="card card-body cart-table">
                     <div class="table-responsive">
                        <table class="table cart_summary">
                           <thead>
                              <tr>
                                 <th class="cart_product">Product</th>
                                 <th style="text-align:center;">Name</th>
                                 <th style="text-align:center;">Availability</th>
                                 <th style="text-align:center;">Unit price</th>
                                 <th style="text-align:center;">Qty</th>
                                 <th style="text-align:center;">Total</th>
                                 <th style="text-align:center;" class="action"><i class="mdi mdi-delete-forever"></i></th>
                              </tr>
                           </thead>
                           <tbody>
                             <?php
                                                           
                                 $totalAmount =  0;
                                 $getCartProductsQuery = "SELECT * FROM `tbl_cart` WHERE cus_id = '$cusId' and status='0'";
                                 $cartDetailResults = mysqli_query($db,$getCartProductsQuery);
                                 while($rowProduct = mysqli_fetch_array($cartDetailResults)){
                                     $pro_Id_Cart = $rowProduct['product_id'];
                                     $proQty_Cart = $rowProduct['quantity'];
                                     

                                     $getProductOtherDetails = "SELECT * FROM `tbl_product`where pro_id = '$pro_Id_Cart'";
                                     $otherProductDetailsResults = mysqli_query($db,$getProductOtherDetails);
                                     $otherProductResult = mysqli_fetch_array($otherProductDetailsResults);
                                     $discountStatus = $otherProductResult['pro_discount_status'];
                                     $discountAmount = $otherProductResult['pro_discount_amount'];
                                     $avialabilityStatus = $otherProductResult['pro_available_status'];                          
                                    $pro_Image = $otherProductResult['pro_image'];
                                    $pro_Name = $otherProductResult['pro_name'];
                                    $pro_Price = $otherProductResult['pro_display_price']; 
                                     $avai_Stock = $otherProductResult['pro_available_stock'];
                                                           
                            ?>
                              <tr>
                                 <td class="cart_product"><a href="#"><img class="img-fluid img-cart" src="img/item/<?= $pro_Image?>" alt=""></a></td>
                                 
                                  <td class="cart_description">
                                    <h5 class="product-name"><a href="#"><?= $pro_Name ?> </a></h5>
                                    <?php if($avialabilityStatus == 1  && $avai_Stock !=0){ ?>
                                    <h6><strong><span class="mdi mdi-approval"></span> Now Available </strong><span style="color:orange; font-size:14px;"><?= $avai_Stock ?> Item(s) </span></h6>
                                    <?php } else { ?>
                                    
                                    <h6><strong><span class="mdi mdi-approval"></span> Not Available</strong></h6>
                                    <?php } ?>
                                 </td>
                                  
                                 <?php if($avialabilityStatus == 1 && $avai_Stock !=0){ ?>
                                     <td style="text-align:center;" class="availability in-stock"><span class="badge badge-success">In stock</span></td>
                                 <?php } else { ?>
                                     <td style="text-align:center;" class="availability in-stock"><span class="badge badge-danger">Stock Out</span></td>
                                 <?php } ?>
                                 
                                 
                                  <?php if($discountStatus==1){
                                        $singleProductPrice = $pro_Price - (($pro_Price * $discountAmount)/100);
                                ?>
                                 <td style="text-align:center;" class="price"><span><?= $singleProductPrice ?></span></td>
                                 <?php }else{
                                  
                                  $singleProductPrice = $pro_Price ;
                                  ?>
                                    <td style="text-align:center;" class="price"><span><?= $singleProductPrice ?></span></td>
                                <?php } ?>
                                 
                                 
                                 
                                 <td class="qty">
                                   <form action="" method="post">
                                    <div class="input-group">
                                      <!--<form action="" method="post">-->
                                      <input type="text" name="pro_id" value="<?= $pro_Id_Cart ?>" hidden >
                                      <input type="text" name="pro_Price" value="<?= $pro_Price ?>" hidden >
                                      <?php if($proQty_Cart > 1){  ?>
                                      <span class="input-group-btn"><button value="<?= $proQty_Cart ?>" name="btnQtyDec" class="btn qtyChangeBtn btn-theme-round btn-number btnCartQtyDec" type="button" id="<?= $pro_Id_Cart ?>">-</button></span>
                                      <?php }else { ?>
                                      <span class="input-group-btn"><button value="<?= $proQty_Cart ?>" name="btnQtyDec" disabled="disabled" class="btn qtyChangeBtn btn-theme-round btn-number btnCartQtyDec" type="button" id="<?= $pro_Id_Cart ?>">-</button></span>
                                      
                                      <?php } ?>
                                      
                                       
                                       <input  onkeydown="return false" type="text" max="10" min="1" value="<?= $proQty_Cart ?>" class="form-control border-form-control form-control-sm qtyTextCart input-number" name="quantChange">
                                       <?php if($proQty_Cart < 10){  ?>
                                       <span class="input-group-btn"><button value="<?= $proQty_Cart ?>" name="btnQtyInc" id="<?= $pro_Id_Cart ?>" class="btn qtyChangeBtn btn-theme-round btn-number btnCartQtyInc" type="button">+</button>
                                       </span>
                                       <?php }else { ?>
                                       <span class="input-group-btn"><button value="<?= $proQty_Cart ?>" name="btnQtyInc" id="<?= $pro_Id_Cart ?>" disabled class="btn btn-theme-round qtyChangeBtn btn-number btnCartQtyInc" type="button">+</button>
                                       </span>
                                       
                                       <?php } ?>
                                       <!--</form>--> 
                                    </div>
                                    </form>
                                 </td>
                                 
                                 
                                 <?php $totOfProduct = $singleProductPrice * $proQty_Cart ?>
                                 <td style="text-align:center;" class="price"><span><?= $totOfProduct ?></span></td>
                                 
                                 
                                 
                                 <td style="text-align:center;" class="action">
                                   <form method="post" action="">
                                   <input type='hidden' name='product_id' value="<?= $pro_Id_Cart; ?>" />
                                    <button id="<?= $pro_Id_Cart; ?>" name="btnRemove" type="button" class="btn btn-sm btn-danger btnCartProductRemove" data-original-title="Remove" href="#" title="" data-placement="top" data-toggle="tooltip"><i class="mdi mdi-close-circle-outline"></i></button>
                                    </form>
                                 </td>
                                 
                                 
                                 
                              </tr>
                              
                              <?php $totalAmount = $totalAmount + $totOfProduct; } ?>
                           </tbody>
                           <tfoot>
                              
                           </tfoot>
                        </table>
                     </div>
                     
                     <div class="card-footer cart-sidebar-footer">
                        <div class="cart-store-details">
                           <p>Sub Total <strong class="float-right">Rs. <?=  $totalAmount ?></strong></p>
                           <p>Delivery Charges <strong class="float-right text-danger">Delivery charges will vary acccording to delivery location</strong></p>
                        </div>
                        
                     </div>
                     
                     
                     <button class="btn btn-secondary btn-lg btn-block text-left proceedToCheckOut" type="button"><span class="float-left"><i class="mdi mdi-cart-outline"></i> Proceed to Checkout </span><span class="float-right"><strong>Rs. <?=  $totalAmount ?></strong> <span class="mdi mdi-chevron-right"></span></span></button>
                     
                     
                  </div>
                   
                   
                   <?php }
                       else
                       {
                           echo "<h3>Your cart is empty!</h3>";
                       }
                   
                   
                   } ?>
                  
               </div>
            </div>
         </div>
      </section>
        <section class="section-padding bg-white border-top">
         <div class="container">
            <div class="row">
               <?php
                getAllIdeaBoxes();
             ?>
              
            </div>
         </div>
      </section>
      <!-- Footer -->
      <section class="section-padding footer bg-white border-top">
         <?php include("assets/footer.php"); ?>
      </section>
      <!-- End Footer -->
      <!-- Copyright -->
      
      <!-- End Copyright -->
      
      
      <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
      <!-- Bootstrap core JavaScript -->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- select2 Js -->
      <script src="vendor/select2/js/select2.min.js"></script>
      <!-- Owl Carousel -->
      <script src="vendor/owl-carousel/owl.carousel.js"></script>
      <!-- Custom -->
      <script src="js/custom.js"></script>
      <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
  
  
       <script>  
     $(document).ready(function(){  
          $(".btnSideCartremove").click(function () {
              var product_id = $(this).attr("id");
               $.ajax({  
                    url:"sideCartItemRemove.php",  
                    method:"post",  
                    data:{
                        product_id:product_id
                    },  
                    success:function(data){  
                          toastr.success(
                              '',
                              data,
                              {
                                timeOut: 800,
                                fadeOut: 800,
                                onHidden: function () {
                                    location.reload();
                                  }
                              }
                            );
                    }  
               });  
          });  
     });  
     </script>
     
     <script>  
     $(document).ready(function(){  
          $(".btnCartQtyInc").click(function () {
              var product_id = $(this).attr("id");
              var quantChange = $(this).val();
              
               $.ajax({  
                    url:"cartQtyInc.php",  
                    method:"post",  
                    data:{
                        product_id:product_id,
                        quantChange:quantChange
                    },  
                    success:function(data){
                        location.reload();
                    }  
               });  
          });  
     });  
     </script>
     
     <script>  
     $(document).ready(function(){  
          $(".btnCartQtyDec").click(function () {
              var product_id = $(this).attr("id");
              var quantChange = $(this).val();
              
               $.ajax({  
                    url:"cartQtyDec.php",  
                    method:"post",  
                    data:{
                        product_id:product_id,
                        quantChange:quantChange
                    },  
                    success:function(data){
                        location.reload();
                    }  
               });  
          });  
     });  
     </script>
     
     <script>  
     $(document).ready(function(){  
          $(".btnCartProductRemove").click(function () {
              var product_id = $(this).attr("id");
               $.ajax({  
                    url:"sideCartItemRemove.php",  
                    method:"post",  
                    data:{
                        product_id:product_id
                    },  
                    success:function(data){  
                         toastr.success(
                              '',
                              data,
                              {
                                timeOut: 800,
                                fadeOut: 800,
                                onHidden: function () {
                                    location.reload();
                                  }
                              }
                            );
                    }  
               });  
          });  
     });  
     </script>
     
     <script>  
     $(document).ready(function(){  
          $(".proceedToCheckOut").click(function () {
              var product_id = $(this).attr("id");
               $.ajax({  
                    url:"checkForNotAvaibleProduct.php",  
                    method:"post",  
                    data:{
                       
                    },  
                    success:function(data){ 
                        if(data == "Some of the Items to be checkout are not available. Please remove those items which are not available.")
                            {
                              toastr.info(
                              '',
                              data,
                              {
                                timeOut: 3000,
                                fadeOut: 3000,
                                onHidden: function () {
                                    
                                  }
                              }
                            );  
                            }
                        else{
                            window.location.replace('checkout.php');
                            
                        }
                         
                    }  
               });  
          });  
     });  
     </script>
     <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5ec535a26f7d401ccbb85394/1eamb2tme';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
     
     
     
   </body>
</html>


