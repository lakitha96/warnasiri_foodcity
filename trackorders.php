/*
* Following code will provide track order option to user.
* User need to provide OrderID as param to search order.
*/

<?php
session_start();
//session_destroy();
$_SESSION['atPage']="index.php";
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
      <!-- Custom styles -->
      <link href="css/style.css" rel="stylesheet">
      
      <!-- Owl Carousel -->
      <link rel="stylesheet" href="vendor/owl-carousel/owl.carousel.css">
      <link rel="stylesheet" href="vendor/owl-carousel/owl.theme.css">
      <link href=" https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
      <link href="css/newStyles.css" rel="stylesheet">
   </head>
   <body>
     <?php if(isset($_POST['btnAddToCart'])) { ?>
     <div class="loader">
      </div>
      <?php } ?>
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
             <!-- <div class="row">
                 <div class="container" >
                  <div class="input-group mb-2" >
                  <input style="max-width:300px;" type="text" class="form-control" placeholder="Order ID" aria-label="Order ID" aria-describedby="basic-addon2">
                  <div class="input-group-append">
                    <button style="background-color:red; color:white;" class="btn btn-outline-secondary" type="button">Track Order</button>
                  </div>
                </div>
                </div>
              </div> -->
              <div class="container">
              <div class="banner-form-two wow slideInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
<form method="post" >
<div class="row clearfix">

<div class="form-group col-lg-6 col-md-6 col-sm-12">
<input type="text" id="txtEmail" name="emailid" placeholder="Enter your Email Address" required="">
</div>

<div class="form-group col-lg-6 col-md-6 col-sm-12">
<input type="text" id="txtOrderID" name="trackid" placeholder="Enter Your Order ID" required="">
</div>

<div class="form-group col-lg-12 col-md-12 col-sm-12">
<br><button type="button" class="theme-btn btn-style-three btnTrackOrder">Track Order Now</button>
</div>
</div>
</form>
</div>
 
 <div id="errorOrderID" class="container text-center" hidden>
     <h5 style="color:red;">Please enter correct order information to track an Order</h5><br>
 </div>
 
 
  </div>    
      
                 <div id="orderDetailsView" class="container" hidden>
                      <div class="row">
						<div class="col-12 col-md-12 hh-grayBox pt45 pb20" id="viewOrderDetail">
							
						</div>
					</div>
                </div>
      
      
      
      
    
      
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
        function myLogout() {

          var r = confirm("Are you sure to logout?");
          if (r == true) 
          {
                window.location.replace('assets/logoutuser.php');
          } 
          else 
          {

          }

        }
        </script>
       
       
        
        
       <script>  
     $(document).ready(function(){  
          $(".btnTrackOrder").click(function () {
               var orderEmail = document.getElementById("txtEmail").value;
              
              var orderID = document.getElementById("txtOrderID").value;
              if(orderEmail.indexOf("@") == -1 || orderEmail.length < 6){
                  
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
                      
                 
                 }
                
              
              else if((orderEmail.charAt(orderEmail.length-4)!='.')&& (orderEmail.charAt(orderEmail.length-3)!='.'))
              {
                  
                  toastr.error(
                              '',
                              'Please Re-chec your email address',
                              {
                                timeOut: 3000,
                                fadeOut: 3000,
                                onHidden: function () {
                                    
                                    //location.reload();
                                  }
                              }
                            );
             
              }
              else if(orderID == null || orderID == "")
              {
                  toastr.error(
                              '',
                              'Please enter your order ID',
                              {
                                timeOut: 3000,
                                fadeOut: 3000,
                                onHidden: function () {
                                    
                                    //location.reload();
                                  }
                              }
                            );
                      
              }
              
              else{
               $.ajax({  
                    url:"trackOrderDetails.php",  
                    method:"post",  
                    data:{
                        orderEmail:orderEmail,orderID:orderID
                    },  
                    success:function(data){
                       
                        
                        if(data == "No Data")
                        {
                            $('#errorOrderID').attr('hidden',false); 
                              $('#orderDetailsView').attr('hidden',true);  
                        }
                        else{
                            $('#errorOrderID').attr('hidden',true); 
                           $('#viewOrderDetail').html(data);
                            $('#orderDetailsView').attr('hidden',false);
                        }
                         
                        
                        
                    }  
               });
              }
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

