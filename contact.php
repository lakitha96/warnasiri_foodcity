<?php
session_start();
$_SESSION['atPage']="contact.php";
include("assets/functions.php");
include("assets/db.php");
if(isset($_SESSION['customerId']))
{
    $cusId = $_SESSION['customerId'];
}



//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require 'vendor/autoload.php';



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
      <!-- Custom styles -->
      <link href="css/style.css" rel="stylesheet">
      <!-- Owl Carousel -->
      <link rel="stylesheet" href="vendor/owl-carousel/owl.carousel.css">
      <link rel="stylesheet" href="vendor/owl-carousel/owl.theme.css">
      <link href=" https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
   </head>
   <body>
    <?php if(isset($_POST['btnSendMessage'])) { ?>
     <div class="loader">
      </div>
      <?php } ?>
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
      <!-- Inner Header -->
      <section class="section-padding bg-dark inner-header">
         <div class="container">
            <div class="row">
               <div class="col-md-12 text-center">
                  <h1 class="mt-0 mb-3 text-white">Contact Us</h1>
                  <div class="breadcrumbs">
                     <p class="mb-0 text-white"><a class="text-white" href="#">Home</a>  /  <span class="text-success">Contact Us</span></p>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- End Inner Header -->
      <!-- Contact Us -->
      <section class="section-padding">
         <div class="container">
            <div class="row">
               <div class="col-lg-4 col-md-4">
                  <h3 class="mt-1 mb-5">Get In Touch</h3>
                  <h6 class="text-dark"><i class="mdi mdi-home-map-marker"></i> Address :</h6>
                  <p>No 153, Moratuwa rd, Piliyandala, Sri Lanka</p>
                  <h6 class="text-dark"><i class="mdi mdi-phone"></i> Phone :</h6>
                  <p>+94 71 303 0928, +94 71 903 9314</p>
                  
                  <h6 class="text-dark"><i class="mdi mdi-email"></i> Email :</h6>
                  <p> Dayastoresinfo@gmail.com</p>
                  <h6 class="text-dark"><i class="mdi mdi-link"></i> Website :</h6>
                  <p>www.dayastore.com</p>
                  <div class="footer-social"><span>Follow : </span>
                     <a href="#"><i class="mdi mdi-facebook"></i></a>
                     <a href="#"><i class="mdi mdi-twitter"></i></a>
                     <a href="#"><i class="mdi mdi-instagram"></i></a>
                     <a href="#"><i class="mdi mdi-google"></i></a>
                  </div>
               </div>
               <div class="col-lg-8 col-md-8">
                  <div class="card">
                     <div class="card-body">
                         
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.7752606960767!2d79.9142659508024!3d6.797175321781802!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2455efd544c7d%3A0x41dbf05aae8d7459!2sSuwarapola%20East%2C%20Piliyandala!5e0!3m2!1sen!2slk!4v1589224125617!5m2!1sen!2slk" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- End Contact Us -->
      <!-- Contact Me -->
      <section class="section-padding  bg-white">
         <div class="container">
            <div class="row">
               <div class="col-lg-12 col-md-12 section-title text-left mb-4">
                  <h2>Contact Us</h2>
               </div>
                   <div id="error_message"></div>
               <form  method="post" class="col-lg-12 col-md-12" name="sentMessage" id="contactForm" novalidate>
                  <div class="control-group form-group">
                     <div class="controls">
                        <label>Full Name <span class="text-danger">*</span></label>
                        <input name="txtFullName" type="text" placeholder="Full Name" class="form-control" id="name" required data-validation-required-message="Please enter your name.">
                        <p class="help-block"></p>
                     </div>
                  </div>
                  <div class="row">
                     <div class="control-group form-group col-md-6">
                        <label>Phone Number <span class="text-danger">*</span></label>
                        <div class="controls">
                           <input name="txtContactNo" type="tel" placeholder="947XXXXXXX" class="form-control" id="phone" required data-validation-required-message="Please enter your phone number.">
                        </div>
                     </div>
                     <div class="control-group form-group col-md-6">
                        <div class="controls">
                           <label>Email Address <span class="text-danger">*</span></label>
                           <input name="txtEmailAddress" type="email" placeholder="Email Address"  class="form-control" id="email" required data-validation-required-message="Please enter your email address.">
                        </div>
                     </div>
                  </div>
                  <div class="control-group form-group">
                     <div class="controls">
                        <label>Message <span class="text-danger">*</span></label>
                        <textarea name="txtMessage" rows="4" cols="100" placeholder="Message"  class="form-control" id="message" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
                     </div>
                  </div>
                  <div id="success"></div>
                  <!-- For success/fail messages -->
                  <input type="submit" name="btnSendMessage"   onclick="return validate()"    class="btn btn-success" value="Send Message">
               </form>
            </div>
         </div>
      </section>
      <!-- End Contact Me -->
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
                  <p class="mb-0"><a class="text-success" href="#"><i class="mdi mdi-email"></i> Dayastoresinfo@gmail.com</a></p>
                  <p class="mb-0"><a class="text-primary" href="#"><i class="mdi mdi-web"></i> www.dayastores.com</a></p>
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
                     <a class="btn-facebook" href="https://www.facebook.com/"><i class="mdi mdi-facebook"></i></a>
                     <a class="btn-twitter" href="https://twitter.com/"><i class="mdi mdi-twitter"></i></a>
                     <a class="btn-instagram" href="https://www.instagram.com/"><i class="mdi mdi-instagram"></i></a>
                     <a class="btn-messenger" href="https://www.messenger.com/"><i class="mdi mdi-facebook-messenger"></i></a>
                  
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
      <!-- Contact form JavaScript -->
      <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
      <script src="js/jqBootstrapValidation.js"></script>
      <script src="js/contact_me.js"></script>
      <!-- select2 Js -->
      <script src="vendor/select2/js/select2.min.js"></script>
      <!-- Owl Carousel -->
      <script src="vendor/owl-carousel/owl.carousel.js"></script>
      <!-- Custom -->
      <script src="js/custom.js"></script>
      
      
      
      
      
      <script type="text/javascript">
           
            function validate(){
                
                  var fullname = document.getElementById("name").value;
                       var Phone = document.getElementById("phone").value;
                  var email = document.getElementById("email").value;
                    var Message = document.getElementById("message").value;
                          error_message.style.padding = "10px";
                
                
                 if( fullname ==""){
                text = "Enter Your Full Name ";
                   error_message.innerHTML = text;
                return false;
                 }
                   if( fullname.length>60){
                text = "Please  Enter Your  Full Name Between 1-60 ";
                   error_message.innerHTML = text;
                return false;
                 }  
                 
                 if(!isNaN(fullname) ){
                text = "   Numbers Are Not Allowed For Name";
                   error_message.innerHTML = text;
                return false;
                 }
                
                 if( Phone ==""){
                text = "Enter Your Phone Number ";
                   error_message.innerHTML = text;
                return false;
                 }
                   
                if(isNaN(Phone)    ){
                text = "   Numbers Only Allow For Phone Number";
                   error_message.innerHTML = text;
                return false;
                 }
                if( Phone.length !=11){
                text = "Please Cheak Again Phone Number Correctly ";
                   error_message.innerHTML = text;
                return false;
                 }
                if(email.indexOf("@") == -1 || email.length < 6){
                   text = "Please Enter valid Email";
                  error_message.innerHTML = text;
                      
                 return false;
                 }
                
              
              if((email.charAt(email.length-4)!='.')&& (email.charAt(email.length-3)!='.'))
              {
                  text = ". Invalid Position";
                  error_message.innerHTML = text;
                  return false;
             
              }
                  if(email.length>50)
              {
                  text = "Please Check Again Email Address Correctly";
                  error_message.innerHTML = text;
                  return false;
             
              }
                 if( Message ==""){
                text = "Enter Your Message Please ";
                   error_message.innerHTML = text;
                return false;
                 }
            }
                
      
        </script>
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      <script type="text/javascript">
       window.addEventListener("load", function () {
    const loader = document.querySelector(".loader");
    loader.className += " hidden"; // class "loader hidden"
});
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
<?php
if(isset($_POST['btnSendMessage']))
{
   $txtMessage = $_POST['txtMessage'];   
   $txtEmailAddress = $_POST['txtEmailAddress'];    
   $contactNo = $_POST['txtContactNo'];    
   $txtFullName = $_POST['txtFullName'];    
    
    

//Create a new PHPMailer instance
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->SMTPAuth = true;
$mail->Username = 'dayastoresinfo@gmail.com';
$mail->Password = 'lookatme123Hey';
$mail->setFrom($txtEmailAddress, $txtFullName);
$mail->addReplyTo($txtEmailAddress, $txtFullName);
$mail->addAddress('dayastoresinfo@gmail.com');
$mail->Subject = 'New Mail';
    
$mail->msgHTML($txtMessage);
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) 
{
    //echo 'Mailer Error: '. $mail->ErrorInfo;
    echo "
    <script>
    alert('Something went wrong, Please Try Again - Thankyou!');
    </script>
    
    ";
} 
else 
{
    
    echo "
    <script>
    alert('Thanks for conatcting us, We will reply as soon as posible - Thankyou!');
    </script>
    
    ";
    
}
    
}


?>