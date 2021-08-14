<?php
session_start();

include("assets/functions.php");
include("assets/db.php");
if(isset($_SESSION['customerId']))
{
    $cusId = $_SESSION['customerId'];
}


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require 'vendor/autoload.php';

if(isset($_POST['btnVerifyFogotEmail'])){
    $fogottenEmail = $_POST['fogotEmail'];
}

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
      <title>දයා Store</title>
      <!-- Favicon Icon -->
      <link rel="icon" type="image/png" href="img/dayaStoreLogo.png">
      <!-- Bootstrap core CSS -->
      <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <!-- Material Design Icons -->
      <link href="vendor/icons/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />
      <!-- Select2 CSS -->
      <link href="vendor/select2/css/select2-bootstrap.css" />
      <link href="vendor/select2/css/select2.min.css" rel="stylesheet" />
      <!-- Custom styles  -->
      <link href="css/style.css" rel="stylesheet">
      <link href="css/login.css" rel="stylesheet">
      <!-- Owl Carousel -->
      <link rel="stylesheet" href="vendor/owl-carousel/owl.carousel.css">
      <link rel="stylesheet" href="vendor/owl-carousel/owl.theme.css">
      <link href=" https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
   </head>
   <body>
     <?php if(isset($_POST['btnVerifyFogotEmail'])){ ?>
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
            <a class="navbar-brand" href="index.php"> <img src="img/Daya.png"> </a>
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
      
      <!-- START forgetpassword SECTION -->
<div class="login_register_wrap section">
   
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-md-6">
                <div class="login_wrap">
            		<div class="padding_eight_all bg-white">
                       <img src="img/login.jpg"><br>
                        <div class="heading_s1">
                            <h3>Foget Password</h3>
                        </div>
                         <div id="error_message"></div>
                        <form method="post">
                            <div class="form-group">
                               <label>Enter your E-mail and we'll send you a verification code to reset your password</label>
                               <?php if(isset($_POST['btnVerifyFogotEmail'])){ ?>
                                 <input type="text" readonly required="" class="form-control-login" id="email"  value="<?= $fogottenEmail ?>" name="fogotEmail" placeholder="ex: exapme@gmail.com">
                                 
                                <?php }else { ?>
                               <input type="text" required="" class="form-control-login" id="email"  name="fogotEmail" placeholder="ex: exapme@gmail.com">
                               
                               <?php } ?>
                               
                                
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" name="btnVerifyFogotEmail"  onclick = "return validate()"  class="btn btn-lg btn-secondary btn-block">Get Verification Code</button>
                            </div>
                        </form>
                           <form action="assets/fogotPasswordRecover.php" method="post" name="frmFogetPass">
                            <div class="form-group">
                               <label>Verification Code</label>
                                <input class="form-control-login" id="code" required="" type="password" name="password" placeholder="Verify Code">
                            </div>
                            <?php if(isset($_POST['btnVerifyFogotEmail'])){ ?>
                            <div class="form-group">
                               <input hidden class="form-control-login" required="" type="password" value="<?= $fogottenEmail ?>"   id="hidenEmail" name="txtEmailText" >
                            </div>
                            <?php } ?>
                            <div class="form-group">
                               <label>Enter Password</label>
                                <input class="form-control-login" required="" type="password"    id="password" name="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                               <label>Confirm Password</label>
                                <input class="form-control-login" required="" type="password"  id="conpassword"   name="password" placeholder="Password">
                            </div>
                            
                            <div class="form-group">
                                <?php if(isset($_POST['btnVerifyFogotEmail'])){ ?>
                                <button type="submit" name="btnResetPass"  onclick="return resetcodevalidation()"   class=" btn-lg btn-Login btn-block">Reset Password</button>
                                <?php }else{ ?>
                                <button type="submit" disabled onclick="return resetcodevalidation()"   class=" btn-lg btn-Login btn-block">Reset Password</button>
                                
                                <?php } ?>
                            </div>
                            
                        </form>
                        <div class="different_login">
                            <span> or</span>
                        </div>
                        
                        <div class="form-note text-center">Don't Have an Account? <a href="register.php">Sign up now</a></div>
                    </div>
                </div>
            </div>
           
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
      
      <script type="text/javascript">
       window.addEventListener("load", function () {
    const loader = document.querySelector(".loader");
    loader.className += " hidden"; // class "loader hidden"
});
       </script>
       
      <script type="text/javascript">
           
            function validate(){
                
                  var email = document.getElementById("email").value;
                
                error_message.style.padding = "10px";
               
                
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
             
              }if(email.length>50)
              {
                  text = "Please Check Again Email Address Correctly";
                  error_message.innerHTML = text;
                  return false;
             
              }
                
                
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
   <?php
if(isset($_POST['btnVerifyFogotEmail']))
{
    $fogotemail = $_POST['fogotEmail'];
    
    $checkSimilarMail = "select cus_email from tbl_customer where cus_email = '$fogotemail'";
    $result = mysqli_query($con,$checkSimilarMail)  ;  
    
    $numRows = mysqli_num_rows($result);
     if($numRows <= 0)
     {
         echo "
            <script>
                alert('Please make sure that entered Email address is correct - Thankyou!');
                 window.location.replace('$page');
            </script>
         ";
     }
    else{
    
$random_no = mt_rand(100000,999999); 

//Create a new PHPMailer instance
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->SMTPAuth = true;
$mail->Username = 'warnasirifoodcity@gmail.com';
$mail->Password = 'xuuqbepniuwgtxvg';
$mail->setFrom('warnasirifoodcity@gmail.com', 'Warnasiri FoodCity');
$mail->addReplyTo('warnasirifoodcity@gmail.com', 'Warnasiri FoodCity');
$mail->addAddress($fogotemail);
$mail->Subject = 'Password Recovery - Warnasiri FoodCity';
    
$mail->msgHTML("<body>
        <div style='background-color: #55aa1b; height: 52px;'>
            <h2 style='padding-top:10px;'>Warnasiri FoodCity</h2>
        </div>
        <h3 style='color: orange'>
Welcome to Warnasiri FoodCity! Confirm your E-mail address.</h3>
       <p>Dear Sir/Madam,<br><br>Welcome to the Warnasiri FoodCity family!</p>
        <P>Add another layer of security to your Warnasiri FoodCity account by confirming your email address.
By confirming your email address receive promotional emails and recover your account details</P>
      <p>Your Account confirmation code</p>
       <div style='background-color: aquamarine; height: 40px; width: 150px; margin: auto; border-color: black; border-style: solid;'>
           <p style='text-align: center; margin-top: 6px; font-size: 20px; font-weight: bold;'>$random_no</p>
       </div>
       <p>Sincerely,<br>
warnasirifoodcity.com</p>
       
    </body>");
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
    
    //echo "
    //<script>
    //alert('We have sent you the verification code - Thankyou!');
    //</script>
    
    //";
    
}
    }
    
}



?>

<script type="text/javascript">
    function resetcodevalidation()
          {       var verifycode = document.getElementById("code").value;
                 var pass = document.getElementById("password").value;
                var conpass=document.getElementById("conpassword").value;
                var pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
                var error_message = document.getElementById("error_message");
           
             error_message.style.padding = "10px";
           
            if(verifycode ==""){
                text = "Please  Enter Verify Code";
                   error_message.innerHTML = text;
                return false;
                 }
           else if(isNaN(verifycode)    ){
                text = "  Only  Numbers Are Allowed";
                   error_message.innerHTML = text;
                return false;
                 }
           else if(verifycode != "<?php echo $random_no; ?>")
                {
                  text = "Please make sure that your entered verification code is correct";
                  error_message.innerHTML = text;
                  return false;
                }
           
            else if(pass ==""){
                text = "Please  Enter Your Password";
                   error_message.innerHTML = text;
                return false;
                 }
                 else if(!(pass.match(pattern))){
                text = "New password should between 6 to 20 characters which contain at least one numeric digit, one uppercase and one lowercase letter";
                   error_message.innerHTML = text;
                return false;
                 }
           else if(pass.length>20){
                text = "Please  Enter Your Password Between 1-20";
                   error_message.innerHTML = text;
                return false;
                 }
               else if(conpass ==""){
                text = "Please  Enter Your Confirm Password";
                   error_message.innerHTML = text;
                return false;
                 }
                 
                 else if(!(conpass.match(pattern))){
                text = "Confirm password should between 6 to 20 characters which contain at least one numeric digit, one uppercase and one lowercase letter";
                   error_message.innerHTML = text;
                return false;
                 }
                
                else if(pass != conpass){
                text = "Password not matching";
                   error_message.innerHTML = text;
                return false;
                 }
           else{
               return true;
           }
                
                
                
                
                
              
          }
    
    </script>
</html>
