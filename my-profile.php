<?php
session_start();
$_SESSION['atPage']="my-profile.php";
include("assets/functions.php");
include("assets/db.php");
if(isset($_SESSION['customerId']))
{
    $cusId = $_SESSION['customerId'];
}

if(isset($_SESSION['cusEmailaddress']))
{
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
else{
     echo "
                    <script>
                        function goBack(){
                            alert('Please Log to accses My Account!');
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
      
      <title>Waranasiri FoodCity</title>
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
      <section class="account-page section-padding">
         <div class="container">
           <form action="assets/updateAccount.php"  method="post" name="frmAccount"  enctype="multipart/form-data">
            <div class="row">
               <div class="col-lg-9 mx-auto">
                  <div class="row no-gutters">
                     <div class="col-md-4">
                       
                        <div class="card account-left">
                           <div class="user-profile-header">
                             <?php
                               if($customerImage==null || $customerImage =="")
                               {
                                   $customerImage="commonuser.jpg";
                               }
                               else
                               {
                                  
                               }
                               ?>
                             
                              <img class="profilePic" alt="logo" src="img/user/<?= $customerImage ?>" id="img" >
                              <label for="file"  style="position:absolute;border: none;cursor: pointer;border-radius: 25px; margin-top:70px; margin-left:-40px;" >
                              <img  style="height:40px; width:40px; background:#f9f9f9;" src="img/icon/edit-tools.png"      >
                              
                              <input  name="userUploadimage"  type="file" id="file" style="display: none" accept="image/gif,image/jpeg,image/jpg,image/png" multiple="" data-original-title="upload photos"   onchange="preview(event)"  >
                            </label>
                              <h5 class="mb-1 text-secondary"><?php if($customerFName==""){echo "My Account";}else{ echo "$customerFName"; }  ?></h5>

                              
                           </div>
                           
                           <div class="list-group">
                              <a href="my-profile.php" class="list-group-item list-group-item-action active"><i aria-hidden="true" class="mdi mdi-account-outline"></i>  My Profile</a>
                              <a href="Account-Settings.php" class="list-group-item list-group-item-action"><i aria-hidden="true" class="mdi mdi-account-settings-variant"></i>  Account Settings</a>
                             
                              <a href="orderlist.php" class="list-group-item list-group-item-action"><i aria-hidden="true" class="mdi mdi-format-list-bulleted"></i> My Orders</a> 
                              
                              <a href="returnList.php" class="list-group-item list-group-item-action"><i aria-hidden="true" class="mdi mdi-keyboard-return"></i> Return Orders</a> 
                              
                              <a onclick="myLogout()" href=# class="list-group-item list-group-item-action"><i aria-hidden="true" class="mdi mdi-lock"></i>  Logout</a> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-8">
                        <div class="card card-body account-right">
                           <div class="widget">
                              <div class="section-header">
                                 <h5 class="heading-design-h5">
                                    My Profile
                                 </h5>
                              </div>
                              <div id="error_message"></div>
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
                                          <label class="control-label">Phone <span class="required">*</span></label>
                                           <input class="form-control border-form-control"  name="contactno" id="pno"  value="<?= $customerPhone ?>" placeholder="ex :94712345678" type="text">
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label class="control-label">Email Address <span class="required">*</span></label>
                                          <input class="form-control border-form-control " id="emailid" name="email" value="<?= $customerEmail ?>" placeholder="ex :example@gmail.com" disabled="" type="email">
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
                                          <label class="control-label">City <span class="required">*</span></label>
                                          <select name="userCity" class="select2 form-control border-form-control" id="cityid">
                                            <?php
                                                
                                                  if($customerCity=="Piliyandala")
                                                 {
                                                     echo "
                                                    <option   value=''>Select City</option>
                                                    <option selected value='Piliyandala'>Piliyandala</option>
                                                    <option value='Kesbewa'>Kesbewa</option>
                                                    <option value='Mortuwa'>Mortuwa</option>
                                                    <option value='Boralasgamuwa'>Boralasgamuwa</option>
                                                    
                                                    ";
                                                 }
                                                 else if($customerCity=="Kesbewa")
                                                 {
                                                      echo "
                                                    <option   value=''>Select City</option>
                                                    <option  value='Piliyandala'>Piliyandala</option>
                                                    <option selected value='Kesbewa'>Kesbewa</option>
                                                    <option value='Mortuwa'>Mortuwa</option>
                                                    <option value='Boralasgamuwa'>Boralasgamuwa</option>
                                                    
                                                    ";
                                                 }
                                                 else if($customerCity=="Mortuwa")
                                                 {
                                                      echo "
                                                    <option   value=''>Select City</option>
                                                    <option  value='Piliyandala'>Piliyandala</option>
                                                    <option  value='Kesbewa'>Kesbewa</option>
                                                    <option selected value='Mortuwa'>Mortuwa</option>
                                                    <option value='Boralasgamuwa'>Boralasgamuwa</option>
                                                    
                                                    ";
                                                 }
                                                 else if($customerCity=="Boralasgamuwa")
                                                 {
                                                     echo "
                                                    <option   value=''>Select City</option>
                                                    <option  value='Piliyandala'>Piliyandala</option>
                                                    <option  value='Kesbewa'>Kesbewa</option>
                                                    <option  value='Mortuwa'>Mortuwa</option>
                                                    <option selected value='Boralasgamuwa'>Boralasgamuwa</option>
                                                    
                                                    ";
                                                 }
                                                 else{
                                                      echo "
                                                    <option  selected value=''>Select City</option>
                                                    <option  value='Piliyandala'>Piliyandala</option>
                                                    <option  value='Kesbewa'>Kesbewa</option>
                                                    <option  value='Mortuwa'>Mortuwa</option>
                                                    <option  value='Boralasgamuwa'>Boralasgamuwa</option>
                                                    
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
                                 <div class="row">
                                    <div class="col-sm-12 text-right">
                                       <button type="reset" class="btn btn-danger btn-lg"> Cancel </button>
                                       <input type="submit"  name="btnSave" onclick = "return validate()" class="btn btn-success btn-lg" value="Save Changes"> 
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
             </form>
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
      
      
       <script type="text/javascript">
           
            function validate(){
                
                  var firstname = document.getElementById("fname").value;
                 var lastname = document.getElementById("lname").value;
                var phone = document.getElementById("pno").value;
                var Nic = document.getElementById("nicno").value;
                  var City = document.getElementById("cityid");
                   var letters = /^[A-Za-z]+$/;
                var User = City.options[City.selectedIndex].value;
                
                 var Address = document.getElementById("address").value;
                
                var error_message = document.getElementById("error_message");
           
                  error_message.style.padding = "10px";
      
   
                  if( firstname ==""){
                text = "Enter Your First Name ";
                   error_message.innerHTML = text;
                return false;
                 }
                   if( !(firstname.match(letters))){
                text = "Please  Check First Name Again..!  Characters Only Accepted ";
                   error_message.innerHTML = text;
                return false;
                 }
                  if( firstname.length>20){
                text = "Enter Your First Name Between 1-20";
                   error_message.innerHTML = text;
                return false;
                 }

                  if( lastname ==""){
                text = "Enter Your Last Name";
                   error_message.innerHTML = text;
                return false;                                                    
                 }
                
                 if( !(lastname.match(letters))    ){
                text = "   Please  Check Last Name Again..!  Characters Only Accepted";
                   error_message.innerHTML = text;
                return false;
                 }
                 if( lastname.length>20){
                text = "Enter Your Last Name Between 1-20";
                   error_message.innerHTML = text;
                return false;
                 }
                 if( phone ==""){
                text = "Enter Your Phone Number ";
                   error_message.innerHTML = text;
                return false;
                 }
                   
                if(isNaN(phone)    ){
                text = "   Numbers Only Allow For Phone Number";
                   error_message.innerHTML = text;
                return false;
                 }
                if( phone.length !=11){
                text = " Please Cheak Again Phone Number Correctly";
                   error_message.innerHTML = text;
                return false;
                 }
                if( Nic ==""){
                text = "Enter Your NIC Number";
                   error_message.innerHTML = text;
                return false;
                }
                     if(( Nic.length != 10)&&(Nic.length !=12)){
                text = "Please Check Your NIC Number Correctly";
                   error_message.innerHTML = text;
                return false;
            }
            
            if( Nic.length==12 && isNaN(Nic)){
                    
                    
                            text = "Please Check Your NIC Number Again ";
                         error_message.innerHTML = text;
                      return false;
                            
                        
                
                }
                
                if( Nic.length==10 && !isNaN(Nic)){
                    
                    
                            text = "Please Check Your NIC Number Again ";
                         error_message.innerHTML = text;
                      return false;
                            
                        
                
                }
            
                 if(User == 0){
                text = "Please Selecet City";
                   error_message.innerHTML = text;
                return false;
            }
                
            if(Address == ""){
                text = "Please Enter Your Address";
                   error_message.innerHTML = text;
                return false;
            }
                  
                   
                else{
                    
                   return true;
                }
                 
            }
      
       </script>
         
       <script type="text/javascript">
                                 
           
         function preview(event)
           {
               
               var input =  event.target.files[0];
              var reader=new FileReader();
               
               reader.onload = function()
               {
                   var result=reader.result;
                   var img=document.getElementById('img');
                   img.src=result;
               }
                reader.readAsDataURL(input);
           }
      
       
       </script>
        
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

?>