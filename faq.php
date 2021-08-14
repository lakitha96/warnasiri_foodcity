<?php
session_start();
$_SESSION['atPage']="faq.php";
include("assets/functions.php");
include("assets/db.php");
if(isset($_SESSION['customerId']))
{
    $cusId = $_SESSION['customerId'];
}



?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
      <title>දයා Store</title>
      <!-- Favicon Icon -->
      <link rel="icon" type="image/png" href="img/WarnasiriIconLogo.jpeg">
      <!-- Bootstrap core CSS -->
      <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <!-- Material Design Icons -->
      <link href="vendor/icons/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />
      <!-- Select2 CSS -->
      <link href="vendor/select2/css/select2-bootstrap.css" />
      <link href="vendor/select2/css/select2.min.css" rel="stylesheet" />
      <!-- Custom styles  -->
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
            <a class="navbar-brand" href="index.php"> <img src="img/WarnasiriLogo.png"> </a>
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
      <section class="faq-page section-padding">
         <div class="container">
            <div class="row">
               <div class="col-lg-10 mx-auto">
                  <div class="row">
                     <div class="col-lg-12 col-md-12">
                        <div class="card card-body">
                           <div class="accordion" id="accordionExample">
                           <?php
                               getFaq();
                               
                               ?>
                           </div>
                        </div>
                     </div>
                     
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
         <div class="container">
            <div class="row">
               <div class="col-lg-3 col-md-3">
                  <h4 class="mb-5 mt-0"><a class="logo" href="index.php"><img src="img/WarnasiriLogo.png">  </a></h4>
                  <p class="mb-0"><a class="text-dark" href="#"><i class="mdi mdi-phone"></i> +94 719 039 314</a></p>
                  <p class="mb-0"><a class="text-dark" href="#"><i class="mdi mdi-cellphone-iphone"></i> +94 71 303 0928, +94 71 903 9314</a></p>
                  <p class="mb-0"><a class="text-success" href="#"><i class="mdi mdi-email"></i> ashenvp1@gmail.com</a></p>
                  <p class="mb-0"><a class="text-primary" href="#"><i class="mdi mdi-web"></i> www.dayastore.com</a></p>
               </div>
               <div class="col-lg-2 col-md-2">
                  <h6 class="mb-4">MY ACCOUNT </h6>
                  <ul>
                  <li><a href="login.php">Login / Register</a></li>
                  <li><a href="my-profile.php">My Profile</a></li>
                  <li><a href="my-profile.php">Logout</a></li>
                 
                   </ul>
               </div>
               <div class="col-lg-2 col-md-2">
                  <h6 class="mb-4">TOP CATEGORIES</h6>
                  <ul>
                  <li><a href="shop.php?product_catogory=Beverages">Beverages</a></li>
                  <li><a href="shop.php?product_catogory=Grocery">Grocery</a></li>
                  <li><a href="shop.php?product_catogory=Household">Household</a></li>
                  <li><a href="shop.php?product_catogory=Homeware">Homeware</a></li>
                  
                  </ul>
               </div>
               <div class="col-lg-2 col-md-2">
                  <h6 class="mb-4">ABOUT US</h6>
                  <ul>
                  <li><a href="about.php">About Us</a></li>
                  <li><a href="contact.php">Contact Us</a></li>
                  <li><a href="faq.php">FAQ</a></li>
                  
                  </ul>
               </div>
               <div class="col-lg-3 col-md-3">
                  <h6 class="mb-4">GET IN TOUCH</h6>
                  <div class="footer-social">
                     <a class="btn-facebook" href="#"><i class="mdi mdi-facebook"></i></a>
                     <a class="btn-twitter" href="#"><i class="mdi mdi-twitter"></i></a>
                     <a class="btn-instagram" href="#"><i class="mdi mdi-instagram"></i></a>
                     <a class="btn-whatsapp" href="#"><i class="mdi mdi-whatsapp"></i></a>
                     <a class="btn-messenger" href="#"><i class="mdi mdi-facebook-messenger"></i></a>
                     <a class="btn-google" href="#"><i class="mdi mdi-google"></i></a>
                  </div>
                  
               </div>
            </div>
         </div>
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