<?php
session_start();
$_SESSION['atPage']="about.php";
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
      <!-- Custom styles-->
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
      <!-- Inner Header -->
      <section class="section-padding bg-dark inner-header">
         <div class="container">
            <div class="row">
               <div class="col-md-12 text-center">
                  <h1 class="mt-0 mb-3 text-white">About Us</h1>
                  <div class="breadcrumbs">
                     <p class="mb-0 text-white"><a class="text-white" href="#">Home</a>  /  <span class="text-success">About Us</span></p>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- End Inner Header -->
      <!-- About -->
      <section class="section-padding bg-white">
         <div class="container">
            <div class="row">
               <div class="pl-4 col-lg-5 col-md-5 pr-4">
                  <img class="rounded img-fluid" src="img/about.jpg" alt="Card image cap">
               </div>
               <div class="col-lg-6 col-md-6 pl-5 pr-5">
                  <h2 class="mt-5 mb-5 text-secondary">Save more with GO! We give you the lowest prices on all your grocery needs.</h2>
                  <h5 class="mt-2">About Us</h5>
                   <p>Warnasiri Food City is more than a corporation; we believe in empowering and uplifting the livelihoods of the people in our great nation, both at the start of this mart and now with the current Covid-19 outbreak, while remaining environmentally conscious, providing nourishing and safe food, and encouraging the consumption of local produce to uplift the nation.We opened our new website order your foods to your door step without any circumstances.</p>
                 
               </div>
            </div>
         </div>
      </section>
      <!-- End About -->
      <!-- What We Provide -->
      <section class="section-padding bg-white border-top border-bottom">
         <div class="container">
            <div class="row">
               <?php
                getAllIdeaBoxes();
             ?>
              
            </div>
         </div>
      </section>
      <!-- End What We Provide -->
      <!-- Our Team -->
      <section class="section-padding bg-white">
         <div class="section-title text-center mb-5">
            <h2></h2>
            
         </div>
         <div class="container">
            <div class="row"  style="text-align:center;">
               
               <div class="col-12">
                  <div class="team-card text-center">
                     <img class="img-fluid mb-4" src="img/user/dataStoreOwner.jpeg" alt="">
                     <p class="mb-4">If you’re already innately good at something, or have a skillset, embrace it. Don’t try to be all things for all aspects of your business. Hire out or sign contracts with agencies for the things you can’t do, and focus on your strengths as quickly and often as possible. Don’t be a jack-of-all-trades and a master of none.

</p>
                     <h6 class="mb-0 text-success">- Thissa Perera</h6>
                     <small>Owner</small>
                  </div>
               </div>
               
            </div>
         </div>
      </section>
      <!-- End Our Team -->
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