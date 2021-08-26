<?php
session_start();
$_SESSION['atPage']="checkout.php";
include("assets/functions.php");

include("assets/db.php");
if(isset($_SESSION['customerId']))
{
    $cusId = $_SESSION['customerId'];
    $checkAvailableProductInCart = "SELECT COUNT(*)as productInCart FROM `tbl_cart` WHERE cus_id='$cusId' and status = '0'";
    $queryResultOfAvailableProducts = mysqli_query($con,$checkAvailableProductInCart);
    $productResultsAvailble = mysqli_fetch_assoc($queryResultOfAvailableProducts);
    $productCountInCart = $productResultsAvailble['productInCart'];
    if($productCountInCart == 0)
    {
        echo "
                    <script>
                        function goBack(){
                            alert('No products to checkout - Please add some items to checkout!');
                          window.location.replace('shop.php');
                        }
                        
                        goBack();
                    </script>
    ";
    }
    else
    {
        $customerAddress = ""; $customerFName = ""; $customerLName = ""; $customerPhone = ""; $customerEmail = ""; $customerNIC = "";
        $email = $_SESSION['cusEmailaddress'];
    $pass = $_SESSION['cusPassword'];

    $query="SELECT * FROM `tbl_customer` WHERE cus_email='$email' AND cus_password='$pass'";
    $result = mysqli_query($con,$query);
    $rowdata = mysqli_fetch_array($result);
    $customerId = $rowdata['cus_id'];
    $customerFName = $rowdata['cus_fname'];
    $customerLName = $rowdata['cus_lname'];
    $customerPhone = $rowdata['cus_tele'];
    $customerNIC = $rowdata['cus_nic'];
    $customerCity = $rowdata['cus_city'];
    $customerAddress = $rowdata['cus_address'];
    $customerImage = $rowdata['cus_image'];
    $customerEmail = $rowdata['cus_email'];
    $customerPassword = $rowdata['cus_password'];

    }
}
else{
    echo "
                    <script>
                        function goBack(){
                            alert('Please Login to accses checkout page!');
                          window.location.replace('login.php');
                        }
                        
                        goBack();
                    </script>
    ";
}


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
                  Free delivery for orders above <strong><span class="text-light">LKR 5000</span></strong> in Piliyandala area. <br>
                Delivery service operates only in and around <strong><span>Piliyandala area.</span></strong>
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
                        <input class="form-control" name="searchfield" placeholder="Search products.." aria-label="Search products" type="text">
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
                  <a href="#"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span class="mdi mdi-chevron-right"></span> <a href="#">Checkout</a>
               </div>
            </div>
         </div>
      </section>
      <section class="checkout-page section-padding">
         <div class="container">
            <div class="row">
               <div class="col-md-8">
                  <div class="checkout-step">

                     <div class="accordion" id="accordionExample">
                       <form method="post">
                        <div class="card checkout-step-one">
                           <div class="card-header" id="headingOne">
                              <h5 class="mb-0">
                                 <button class="btn btn-link sectionOne" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                 <span class="number">1</span> Enter Phone Number
                                 </button>
                              </h5>
                           </div>
                           <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <div class="card-body">
                                 <p>We need your phone number so that we can update you about your order.</p><p>Eg : <span  style="color:red;">94712345678</span></p>
                                 <form>
                                    <div class="form-row align-items-center">
                                       <div class="col-auto">
                                          <label class="sr-only">phone number</label>
                                          <div class="input-group mb-2">
                                             <div class="input-group-prepend">
                                                <div class="input-group-text"><span class="mdi mdi-cellphone-iphone"></span></div>
                                             </div>
                                             <input name="txtContacNo" id="txtContacNo" type="text" class="form-control" placeholder="94712345678">
                                          </div>
                                       </div>
                                       <div class="col-auto">
                                          <button type="button" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne" class="btn btn-secondary mb-2 btn-lg sendOtpMsg">Confirm</button>
                                           <button type="button" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo" class="btn btn-warning mb-2 btn-lg chageContactNo" hidden>Change Mobile Number</button>
                                       </div>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>







<!--                        <div class="card checkout-step-two">-->
<!--                           <div class="card-header" id="headingTwo">-->
<!--                              <h5 class="mb-0">-->
<!--                                 <button class="btn btn-link collapsed sectionTwo" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">-->
<!--                                 <span class="number">2</span> Phone Number Verification-->
<!--                                 </button>-->
<!--                              </h5>-->
<!--                           </div>-->
<!--                           <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">-->
<!--                              <div class="card-body">-->
<!--                                 <p>Enter the verification code we have sent to this number.</p>-->
<!--                                 <form>-->
<!--                                    <div class="form-row align-items-center">-->
<!--                                       <div class="col-auto">-->
<!--                                          <label class="sr-only">phone number</label>-->
<!--                                          <div class="input-group mb-2">-->
<!--                                             <div class="input-group-prepend">-->
<!--                                                <div class="input-group-text"><span class="mdi mdi-cellphone-iphone"></span></div>-->
<!--                                             </div>-->
<!--                                             <input type="text" id="txtVeriftyCode" class="form-control" placeholder="Enter verification code">-->
<!--                                          </div>-->
<!--                                       </div>-->
<!--                                       <div class="col-auto">-->
<!--                                          <button type="button" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseThree" class="btn btn-secondary mb-2 btn-lg confirmNumber">Verify Phone NUmber</button>-->
<!--                                       </div>-->
<!--                                    </div>-->
<!--                                 </form>-->
<!--                              </div>-->
<!--                           </div>-->
<!--                        </div>-->












                        <div class="card checkout-step-two">
                           <div class="card-header" id="headingThree">
                              <h5 class="mb-0">
                                 <button class="btn btn-link collapsed sectionThree" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                 <span class="number">2</span> Delivery Address
                                 </button>
                              </h5>
                           </div>
                           <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                              <div class="card-body">
                                 <form>
                                 <div class="row">
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">First Name <span class="required">*</span></label>
                                          <input class="form-control border-form-control"  name="fname"   id="fname" value="<?= $customerFName ?>" placeholder="ex :Kasun" type="text">
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Last Name <span class="required">*</span></label>
                                           <input class="form-control border-form-control" name="lname" id="lname" value="<?= $customerLName ?>" placeholder="ex :Perera" type="text">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">National ID Card Number <span class="required">*</span></label>
                                          <input class="form-control border-form-control" id="nicno" name="nicNo" value="<?= $customerNIC ?>" placeholder="ex :995885578v / 200084517789" type="text">
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Email Address <span class="required">*</span></label>
                                          <input class="form-control border-form-control " id="emailid" name="email" value="<?= $customerEmail ?>" placeholder="ex :example@gmail.com"  type="email">
                                       </div>
                                    </div>
                                 </div>
                                  <div class="row">

                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">City <span class="required">*</span></label><br>
                                          <select name="userCity" class="form-control" style="width:100%;" id="cityid">
                                            <?php

                                                  if($customerCity=="Galle")
                                                 {
                                                     echo "
                                                    <option   value=''>Select City</option>
                                                    <option selected value='Galle'>Galle</option>
                                                    <option value='Hikkaduwa'>Hikkaduwa</option>
                                                    <option value='Ambalangoda'>Ambalangoda</option>
                                                    <option value='Karandeniya'>Karandeniya</option>
                                                    
                                                    ";
                                                 }
                                                 else if($customerCity=="Hikkaduwa")
                                                 {
                                                      echo "
                                                    <option   value=''>Select City</option>
                                                    <option selected value='Galle'>Galle</option>
                                                    <option value='Hikkaduwa'>Hikkaduwa</option>
                                                    <option value='Ambalangoda'>Ambalangoda</option>
                                                    <option value='Karandeniya'>Karandeniya</option>
                                                    
                                                    ";
                                                 }
                                                 else if($customerCity=="Ambalangoda")
                                                 {
                                                      echo "
                                                    <option   value=''>Select City</option>
                                                    <option selected value='Galle'>Galle</option>
                                                    <option value='Hikkaduwa'>Hikkaduwa</option>
                                                    <option value='Ambalangoda'>Ambalangoda</option>
                                                    <option value='Karandeniya'>Karandeniya</option>
                                                    
                                                    ";
                                                 }
                                                 else if($customerCity=="Karandeniya")
                                                 {
                                                     echo "
                                                    <option   value=''>Select City</option>
                                                    <option selected value='Galle'>Galle</option>
                                                    <option value='Hikkaduwa'>Hikkaduwa</option>
                                                    <option value='Ambalangoda'>Ambalangoda</option>
                                                    <option value='Karandeniya'>Karandeniya</option>
                                                    
                                                    ";
                                                 }
                                                 else{
                                                      echo "
                                                    <option   value=''>Select City</option>
                                                    <option selected value='Galle'>Galle</option>
                                                    <option value='Hikkaduwa'>Hikkaduwa</option>
                                                    <option value='Ambalangoda'>Ambalangoda</option>
                                                    <option value='Karandeniya'>Karandeniya</option>
                                                    
                                                    ";
                                                 }

                                            ?>

                                          </select>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group">
                                          <label class="control-label">Address <span class="required">*</span></label>
                                         <textarea name="addressAres" placeholder="" class="form-control border-form-control" id="address"><?= $customerAddress ?></textarea>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="custom-control custom-checkbox">
                                 <?php if($customerFName == null || $customerFName == ""){ ?>
									 <input type="checkbox" class="custom-control-input" name="saveToProfile" value="" id="saveToProfile">
									 <label class="custom-control-label" for="saveToProfile" >Save these data to my account(Email address won't be update) </label>
									 <?php } else { ?>
									 <input type="checkbox" disabled class="custom-control-input" name="saveToProfile" value="" id="saveToProfile">
									 <label class="custom-control-label" for="saveToProfile" >Save these data to my account </label>

									 <?php } ?>
								  </div>
                                 <div class="row">
                                   <div class="col-sm-12">
                                    <br><button type="button" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseFour" class="btn btn-secondary mb-2 btn-lg btnBillingDetails">NEXT</button>
                                     </div>
                                 </div>
                              </form>
                              </div>
                           </div>
                        </div>
                        <div class="card">
                           <div class="card-header" id="headingFour">
                              <h5 class="mb-0">
                                 <button id="confirmOrderCard" class="btn btn-link collapsed sectionFour" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                 <span class="number">3</span> Payment
                                 </button>
                              </h5>
                           </div>
                           <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                              <div class="card-body">
                                 <form class="col-lg-8 col-md-8 mx-auto">
<!--                                    <div class="form-group">-->
<!--                                       <label class="control-label">Card Number</label>-->
<!--                                       <input class="form-control border-form-control" value="" placeholder="0000 0000 0000 0000" type="text">-->
<!--                                    </div>-->
<!--                                    <div class="row">-->
<!--                                       <div class="col-sm-3">-->
<!--                                          <div class="form-group">-->
<!--                                             <label class="control-label">Month</label>-->
<!--                                             <input class="form-control border-form-control" value="" placeholder="01" type="text">-->
<!--                                          </div>-->
<!--                                       </div>-->
<!--                                       <div class="col-sm-3">-->
<!--                                          <div class="form-group">-->
<!--                                             <label class="control-label">Year</label>-->
<!--                                             <input class="form-control border-form-control" value="" placeholder="15" type="text">-->
<!--                                          </div>-->
<!--                                       </div>-->
<!--                                       <div class="col-sm-3">-->
<!--                                       </div>-->
<!--                                       <div class="col-sm-3">-->
<!--                                          <div class="form-group">-->
<!--                                             <label class="control-label">CVV</label>-->
<!--                                             <input class="form-control border-form-control" value="" placeholder="135" type="text">-->
<!--                                          </div>-->
<!--                                       </div>-->
<!--                                    </div>-->
<!--                                    <p class="text-center" style="color:red;">Please make sure currently card payments are not available</p>-->
<!--                                    <div class="custom-control custom-radio">-->
<!--                                       <input type="radio" id="rbtnCardPay" name="customRadio" class="custom-control-input">-->
<!--                                       <label class="custom-control-label" for="rbtnCardPay">Pay by Card Payment</label>-->
<!--                                    </div>-->

                                    <hr>
                                    <div class="custom-control custom-radio">
                                       <input type="radio" id="rbtnCashOnDelivery" name="customRadio" class="custom-control-input">
                                       <label class="custom-control-label" for="rbtnCashOnDelivery">Pay by Cash on Delivery</label>
                                    </div>
                                    <p>Our delivery agents collect the invoice amount of a consignment from its consignee in the form of cash at the time of delivery.</p>

                                    <button type="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseFive" class="btn btn-secondary mb-2 btn-lg btnComfirmOrder testBtnError">Confirm Order</button>
                                 </form>





                              </div>
                           </div>
                        </div>
                        <div class="card">
                           <div class="card-header" id="headingFive">
                              <h5 class="mb-0">
                                 <button id="OrderSuccessCard" class="btn btn-link collapsed sectionFive" type="button" data-toggle="" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                 <span class="number">4</span> Order Complete
                                 </button>
                              </h5>
                           </div>
                           <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                              <div class="card-body">
                                 <div class="text-center">
                                    <div class="col-lg-10 col-md-10 mx-auto order-done">
                                       <i class="mdi mdi-check-circle-outline text-secondary"></i>
                                       <h4 class="text-success">Congrats! Your Order has been Placed..</h4>
                                       <p>
                                          We will contact you after your order has been acceppted - Thankyou!
                                       </p>
                                    </div>
                                    <div class="text-center">
                                       <a href="shop.php"><button type="submit" class="btn btn-secondary mb-2 btn-lg">Return to store</button></a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        </form>
                     </div>

                  </div>
               </div>
               <div   class="col-md-4">
                 <p class="text-center" style="color:red;font-size: 16px;">Please make sure if there are not available products, remove them all before place an order.</p>
                  <div class="card">

                     <h5 class="card-header">My Cart <span class="text-secondary float-right">(<?= $cartCount ?> items)</span></h5>
                     <div  class="card-body pt-0 pr-0 pl-0 pb-0 stopOverFlow">
                      <?php
                       if(isset($_SESSION['cusEmailaddress']))
                       {
                             $totalAmount =  0;
                             $getCartProductsQuery = "SELECT * FROM `tbl_cart` WHERE cus_id = '$cusId' and status='0'";
                             $cartDetailResults = mysqli_query($con,$getCartProductsQuery);
                             while($rowProduct = mysqli_fetch_array($cartDetailResults)){
                                 $pro_Id_Cart = $rowProduct['product_id'];
                                 $proQty_Cart = $rowProduct['quantity'];

                                 $getProductOtherDetails = "SELECT * FROM `tbl_product` where pro_id = '$pro_Id_Cart'";
                                 $otherProductDetailsResults = mysqli_query($db,$getProductOtherDetails);
                                 $otherProductResult = mysqli_fetch_array($otherProductDetailsResults);
                                 $discountStatus = $otherProductResult['pro_discount_status'];
                                 $discountAmount = $otherProductResult['pro_discount_amount'];
                                 $avialabilityStatus = $otherProductResult['pro_available_status'];
                                 $pro_Image = $otherProductResult['pro_image'];
                                 $pro_Name = $otherProductResult['pro_name'];
                                 $pro_Price = $otherProductResult['pro_display_price'];
                                 $avai_Stock = $otherProductResult['pro_available_stock'];

                                 echo "
                                 <div class='cart-list-product'>
                                   
                                    <img class='img-fluid' src='img/item/$pro_Image' alt=''>
                                 ";

                                 if($discountStatus == 1)
                                 {
                                     echo "
                                     <span class='badge badge-success'>$discountAmount% OFF</span>
                                     <span class='float-right remove-cart btnRightcart'><strong>x $proQty_Cart</strong></span>
                                        <h5><a href='#'>$pro_Name</a></h5>
                                     
                                     ";
                                 }
                                 else
                                 {
                                     echo "
                                    <span class='float-right remove-cart btnRightcart'><strong>x $proQty_Cart</strong></span>
                                    <h5><a href='#'>$pro_Name</a></h5>";
                                 }
                                 if($avialabilityStatus == 1 && $avai_Stock != 0)
                                 {
                                     echo "
                                     <h6><strong><span class='mdi mdi-approval'></span> Available Now </strong><span style='color:orange; font-size:13px;'>$avai_Stock Item(s)</span></h6>
                                     ";
                                 }
                                 else
                                 {
                                     echo "
                                     <h6><strong><span class='mdi mdi-approval'></span> Not Available Now</strong></h6>
                                     ";
                                 }
                                 if($discountStatus == 1)
                                 {
                                     $withoutDiscountPrice = $pro_Price * $proQty_Cart;
                                     $withDiscountPrice = $pro_Price - (($pro_Price * $discountAmount)/100);
                                     $dicountedTotalPrice = $withDiscountPrice * $proQty_Cart;

                                     echo "
                                     <p class='offer-price mb-0'>LKR $dicountedTotalPrice <i class='mdi mdi-tag-outline'></i> <span class='regular-price'>$withoutDiscountPrice</span></p>
                                     
                                        </div>
                                     ";
                                 }
                                 else
                                 {
                                     $withoutDiscountPrice = $pro_Price * $proQty_Cart;
                                     echo "
                                     <p class='offer-price mb-0'>LKR $withoutDiscountPrice <i class='mdi mdi-tag-outline'></i> <span class='regular-price'></span></p>
                                        
                                        </div>
                                     ";
                                 }

                                 if($discountStatus==1)
                 {
                     $totalAmount =  $totalAmount + $dicountedTotalPrice;
                 }
                 else
                 {
                    $totalAmount =  $totalAmount + ($pro_Price * $proQty_Cart);
                 }


                             }




                       }
                           ?>







                     </div>
                     <?php
                      echo"
                           
            <a href=''><button class='btn btn-secondary btn-lg btn-block text-left' type='button'><span class='float-left'><strong> Total Amount </strong></span><span class='float-right'><strong>LKR $totalAmount </strong> </span></button></a>
                           
                           
                           ";

                      ?>
                  </div>

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

          $(".removeProductInCheckout").click(function () {
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
                                    $("#productList").load(" #productList");

                                  }
                              }
                            );
                    }
               });
          });
     });
     </script>


      <script>
          var contactNo = "";
         var otpSent = "";
         var verifiedCustomerNumber = "";
         var fName = ""; var lName = ""; var nicNo = ""; var emailAddress = ""; var cityName = ""; var cusAddress = "";
          var progress = "";
          verifiedCustomerNumber = document.getElementById("txtContacNo").value;
          $(document).ready(function(){
         verifiedCustomerNumber = document.getElementById("txtContacNo").value;
              $('.sendOtpMsg').attr('data-target','#collapseOne');
              $('.sendOtpMsg').attr('data-target','#collapseTwo');

         $(".sendOtpMsg").click(function () {
             var mobileNo = document.getElementById("txtContacNo").value;
             verifiedCustomerNumber = document.getElementById("txtContacNo").value;
              if(mobileNo == null || mobileNo == "")
                  {
                      toastr.warning(
                              '',
                              'Please provide a mobile number',
                              {

                                timeOut: 3000,
                                fadeOut: 3000,
                                onHidden: function () {

                                    //location.reload();
                                  }
                              }
                            );
                      $('.confirmNumber').removeAttr('data-target');

                  }
              else if(mobileNo.length != 11)
                  {
                      toastr.error(
                              '',
                              'Please provide a valid mobile number!',
                              {
                                timeOut: 3000,
                                fadeOut: 3000,
                                onHidden: function () {

                                    //location.reload();
                                  }
                              }
                            );
                      $('.confirmNumber').removeAttr('data-target');

                  }
                  else if(isNaN(mobileNo))
                      {

                       toastr.error(
                              '',
                              'Please check again mobile number correctly ',
                              {
                                timeOut: 3000,
                                fadeOut: 3000,
                                onHidden: function () {

                                    //location.reload();
                                  }
                              }
                            );
                      $('.confirmNumber').removeAttr('data-target');



                      }

              else{

               //    $.ajax({
               //      url:"mobileNoVerification.php",
               //      method:"post",
               //      data:{
               //          mobileNo:mobileNo
               //      },
               //      success:function(data){
               //          contactNo = mobileNo;
               //           otpSent = data;
               //
               //            toastr.info(
               //                '',
               //                'Mobile number updated.',
               //                {
               //                  timeOut: 3000,
               //                  fadeOut: 3000,
               //                  onHidden: function () {
               //
               //                      //location.reload();
               //                    }
               //                }
               //              );
               //
               //
               //          //$('#collapseTwo').show();
               //          //$($(this).data("target")).show();
               //      }
               // });
              }

          });
         $(".confirmNumber").click(function () {
             var verificationCode = document.getElementById("txtVeriftyCode").value;
             if(contactNo == null || contactNo == "")
                {
                    toastr.error(
                              '',
                              'Please provide a mobile number',
                              {
                                timeOut: 3000,
                                fadeOut: 3000,
                                onHidden: function () {

                                    //location.reload();
                                  }
                              }
                            );
                     $('.confirmNumber').attr('data-target','#collapseOne');
                }
             else if(verificationCode == null || verificationCode == ""){

                 toastr.warning(
                              '',
                              'Please enter the verification code we sent',
                              {
                                timeOut: 3000,
                                fadeOut: 3000,
                                onHidden: function () {

                                    //location.reload();
                                  }
                              }
                            );

                 $('.confirmNumber').removeAttr('data-target');
             }
              else if(isNaN(verificationCode)){

                 toastr.error(
                              '',
                              'Please check again verification code ',
                              {
                                timeOut: 3000,
                                fadeOut: 3000,
                                onHidden: function () {

                                    //location.reload();
                                  }
                              }
                            );

                 $('.confirmNumber').removeAttr('data-target');
             }




             else if(otpSent == verificationCode)
                 {
                     $('.confirmNumber').removeAttr('data-target');
                     verifiedCustomerNumber = contactNo;
                     toastr.success(
                              '',
                              'Your contact number has been verified',
                              {
                                timeOut: 3000,
                                fadeOut: 3000,
                                onHidden: function () {

                                    //location.reload();
                                  }
                              }
                            );
                     $("#txtContacNo").attr( "disabled", "disabled" );

                     $('.chageContactNo').removeAttr('hidden');
                     $('.confirmNumber').attr('data-target','#collapseThree');
                 }
             else{
                 verifiedCustomerNumber = null;
                 toastr.error(
                              '',
                              'Please re-check your verification code',
                              {
                                timeOut: 3000,
                                fadeOut: 3000,
                                onHidden: function () {

                                    //location.reload();
                                  }
                              }
                            );
                 $('.confirmNumber').removeAttr('data-target');
             }




          });

         $(".btnBillingDetails").click(function () {

             fName = document.getElementById("fname").value;
             lName = document.getElementById("lname").value;
             letters = /^[A-Za-z]+$/;
             emailAddress = document.getElementById("emailid").value;
             nicNo = document.getElementById("nicno").value;
             cityName = document.getElementById("cityid").value;

             cusAddress = document.getElementById("address").value;

             if(verifiedCustomerNumber == null || verifiedCustomerNumber == "")
                 {
                     toastr.warning(
                              '',
                              // 'Plese provode contact number to continue.',
                              {
                                timeOut: 3000,
                                fadeOut: 3000,
                                onHidden: function () {

                                    //location.reload();
                                  }
                              }
                            );
                     $('.btnBillingDetails').attr('data-target','#collapseOne');
                 }
             else if(fName == null || fName == "" || lName == null || lName == "" || emailAddress == null || emailAddress == "" || nicNo == null || nicNo == "" || cityName == null || cityName == "" || cusAddress == null || cusAddress == "" )
                 {
                     toastr.error(
                              '',
                              'Plese provode all billing details!.',
                              {
                                timeOut: 3000,
                                fadeOut: 3000,
                                onHidden: function () {

                                    //location.reload();
                                  }
                              }
                            );
                     $('.btnBillingDetails').removeAttr('data-target');
                 }

              else if(!(fName.match(letters))){


                 toastr.error(
                              '',
                              'Plese check again first name',
                              {
                                timeOut: 3000,
                                fadeOut: 3000,
                                onHidden: function () {

                                    //location.reload();
                                  }
                              }
                            );
                     $('.btnBillingDetails').removeAttr('data-target');

             }
              else if(fName.length>20){


                 toastr.error(
                              '',
                              'Plese check again first name correctly',
                              {
                                timeOut: 3000,
                                fadeOut: 3000,
                                onHidden: function () {

                                    //location.reload();
                                  }
                              }
                            );
                     $('.btnBillingDetails').removeAttr('data-target');

             }
             else if(!(lName.match(letters))){


                 toastr.error(
                              '',
                              'Plese check again last name',
                              {
                                timeOut: 3000,
                                fadeOut: 3000,
                                onHidden: function () {

                                    //location.reload();
                                  }
                              }
                            );
                     $('.btnBillingDetails').removeAttr('data-target');

             }
             else if(lName.length>20){


                 toastr.error(
                              '',
                              'Plese check again last name correctly',
                              {
                                timeOut: 3000,
                                fadeOut: 3000,
                                onHidden: function () {

                                    //location.reload();
                                  }
                              }
                            );
                     $('.btnBillingDetails').removeAttr('data-target');

             }

              else if((  nicNo.length != 10)&&( nicNo.length !=12)){


                 toastr.error(
                              '',
                              'Please Check Your NIC Number correctly',
                              {
                                timeOut: 3000,
                                fadeOut: 3000,
                                onHidden: function () {

                                    //location.reload();
                                  }
                              }
                            );
                     $('.btnBillingDetails').removeAttr('data-target');

             }

             else if( nicNo.length==12 && isNaN( nicNo))
                 {


                 toastr.error(
                              '',
                              'Please Check Your NIC Number Again Correctly ',
                              {
                                timeOut: 3000,
                                fadeOut: 3000,
                                onHidden: function () {

                                    //location.reload();
                                  }
                              }
                            );
                     $('.btnBillingDetails').removeAttr('data-target');

             }

             else if( nicNo.length==10 && !isNaN( nicNo))
                 {


                 toastr.error(
                              '',
                              'Please Check Your NIC Number Again Correctly ',
                              {
                                timeOut: 3000,
                                fadeOut: 3000,
                                onHidden: function () {

                                    //location.reload();
                                  }
                              }
                            );
                     $('.btnBillingDetails').removeAttr('data-target');

             }



               else if(  emailAddress.indexOf("@") == -1 ||   emailAddress.length < 6){


                 toastr.error(
                              '',
                              'Please Enter valid Email',
                              {
                                timeOut: 3000,
                                fadeOut: 3000,
                                onHidden: function () {

                                    //location.reload();
                                  }
                              }
                            );
                     $('.btnBillingDetails').removeAttr('data-target');

             }
               else if(  (emailAddress.charAt(emailAddress.length-4)!='.')&& (emailAddress.charAt(emailAddress.length-3)!='.')){


                 toastr.error(
                              '',
                              '. Invalid Position In Email',
                              {
                                timeOut: 3000,
                                fadeOut: 3000,
                                onHidden: function () {

                                    //location.reload();
                                  }
                              }
                            );
                     $('.btnBillingDetails').removeAttr('data-target');

             }
             else if( emailAddress.length>50){


                 toastr.error(
                              '',
                              'Please Check Again Email Address Correctly',
                              {
                                timeOut: 3000,
                                fadeOut: 3000,
                                onHidden: function () {

                                    //location.reload();
                                  }
                              }
                            );
                     $('.btnBillingDetails').removeAttr('data-target');

             }


             else if(  cusAddress.length >100){


                 toastr.error(
                              '',
                              'Your address must be between 1-100',
                              {
                                timeOut: 3000,
                                fadeOut: 3000,
                                onHidden: function () {

                                    //location.reload();
                                  }
                              }
                            );
                     $('.btnBillingDetails').removeAttr('data-target');

             }




             else{

                 $('.btnBillingDetails').attr('data-target','#collapseFour');
             }

         });

         $(".btnComfirmOrder").click(function () {



             if(verifiedCustomerNumber == null || verifiedCustomerNumber == "")
                 {
                     toastr.warning(
                              '',
                              'Plese provode contact number to continue.',
                              {
                                timeOut: 3000,
                                fadeOut: 3000,
                                onHidden: function () {

                                    //location.reload();
                                  }
                              }
                            );
                     $('.btnComfirmOrder').attr('data-target','#collapseOne');
                 }
             else if(fName == null || fName == "" || lName == null || lName == "" || emailAddress == null || emailAddress == "" || nicNo == null || nicNo == "" || cityName == null || cityName == "" || cusAddress == null || cusAddress == "" )
                 {
                     toastr.error(
                              '',
                              'Plese provode all billing details!.',
                              {
                                timeOut: 3000,
                                fadeOut: 3000,
                                onHidden: function () {

                                    //location.reload();
                                  }
                              }
                            );
                     $('.btnComfirmOrder').attr('data-target','#collapseThree');

                 }

             else{

                $('.btnComfirmOrder').removeAttr('data-target');

                radioCashDeliver = document.getElementById("rbtnCashOnDelivery");
                radioCardPay = document.getElementById("rbtnCardPay");
                 if(radioCashDeliver.checked == false)
                     {
                         toastr.warning(
                              '',
                              'Plese select your payment type.',
                              {
                                timeOut: 3000,
                                fadeOut: 3000,
                                onHidden: function () {

                                    //location.reload();
                                  }
                              }
                            );

                     }
                 // if(radioCardPay.checked == true)
                 //     {
                 //
                 //       var paymentType = "Card Payment";
                 //         toastr.info(
                 //              '',
                 //              'Currently card payments are not available.',
                 //              {
                 //                timeOut: 3000,
                 //                fadeOut: 3000,
                 //                onHidden: function () {
                 //
                 //                    //location.reload();
                 //                  }
                 //              }
                 //            );
                 //     }
                 //
                 // else
                 if(radioCashDeliver.checked == true)
                     {
                         //final step
                         var paymentType = "Cash On Delivery";
                         //var payType = "Cash On Delivery";
                         var saveProfile = "yes";

                         if($("#saveToProfile").prop('checked') == true)
                         {
                              $.ajax({
                                url:"checkoutOrder.php",
                                method:"post",
                                data:{
                                    verifiedCustomerNumber:verifiedCustomerNumber,
                                    fName:fName,
                                    lName:lName,
                                    emailAddress:emailAddress,
                                    nicNo:nicNo,
                                    cityName:cityName,
                                    cusAddress:cusAddress,
                                    saveToProfile:saveProfile,
                                    payType:paymentType

                                },
                                success:function(data){

                                     //showOrderConfirm(data);
                                    if("Your Order Has Been Placed - Thankyou!"  == data)
                                    {


                                        $('.sectionOne').removeAttr('data-toggle');
                                        $('.sectionTwo').removeAttr('data-toggle');
                                        $('.sectionThree').removeAttr('data-toggle');
                                        $('.sectionFour').removeAttr('data-toggle');
                                        $('.sectionFive').removeAttr('data-toggle');

                                        $('.btnComfirmOrder').attr("disabled","disabled");
                                        $('#confirmOrderCard').addClass("collapsed");
                                        $('#OrderSuccessCard').removeClass("collapsed");
                                        $("#cartArea").load(" #cartArea");


                                        toastr.success(
                                          '',
                                          data,
                                          {
                                            timeOut: 3000,
                                            fadeOut: 3000,
                                            onHidden: function () {

                                                //location.reload();
                                              }
                                          }
                                        );
                                        $('#collapseFour').hide();
                                        $('#collapseFive').show();


                                        //$($(this).data("target")).show();




                                    }
                                    else{
                                        toastr.info(
                                          '',
                                          data,
                                          {
                                            timeOut: 3000,
                                            fadeOut: 3000,
                                            onHidden: function () {

                                                //location.reload();
                                              }
                                          }
                                        );
                                    }





                                    //$('#collapseTwo').show();
                                    //$($(this).data("target")).show();
                                }
                           });
                         }
                         else{
                             $.ajax({
                                url:"checkoutOrder.php",
                                method:"post",
                                data:{
                                    verifiedCustomerNumber:verifiedCustomerNumber,
                                    fName:fName,
                                    lName:lName,
                                    emailAddress:emailAddress,
                                    nicNo:nicNo,
                                    cityName:cityName,
                                    cusAddress:cusAddress,
                                    payType:paymentType
                                },
                                success:function(data){

                                     //showOrderConfirm(data);
                                    if("Your Order Has Been Placed - Thankyou!"  == data)
                                    {


                                        $('.sectionOne').removeAttr('data-toggle');
                                        $('.sectionTwo').removeAttr('data-toggle');
                                        $('.sectionThree').removeAttr('data-toggle');
                                        $('.sectionFour').removeAttr('data-toggle');
                                        $('.sectionFive').removeAttr('data-toggle');

                                        $('.btnComfirmOrder').attr("disabled","disabled");
                                        $('#confirmOrderCard').addClass("collapsed");
                                        $('#OrderSuccessCard').removeClass("collapsed");
                                        $("#cartArea").load(" #cartArea");


                                        toastr.success(
                                          '',
                                          data,
                                          {
                                            timeOut: 3000,
                                            fadeOut: 3000,
                                            onHidden: function () {

                                                //location.reload();
                                              }
                                          }
                                        );
                                        $('#collapseFour').hide();
                                        $('#collapseFive').show();


                                        //$($(this).data("target")).show();




                                    }
                                    else{
                                        toastr.info(
                                          '',
                                          data,
                                          {
                                            timeOut: 3000,
                                            fadeOut: 3000,
                                            onHidden: function () {

                                                //location.reload();
                                              }
                                          }
                                        );
                                    }





                                    //$('#collapseTwo').show();
                                    //$($(this).data("target")).show();
                                }
                           });
                         }



                     }



             }

         });

         $(".chageContactNo").click(function () {
             $("#txtContacNo").removeAttr( "disabled", "disabled" );
             contactNo = "";
             verifiedCustomerNumber = "";



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