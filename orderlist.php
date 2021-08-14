<?php
session_start();
$_SESSION['atPage']="orderlist.php";
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
                            alert('Please Log to accses Account Settings!');
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
                              
                              <h5 class="mb-1 text-secondary"><?php if($customerFName==""){echo "My Account";}else{ echo "$customerFName"; }  ?></h5>

                              
                           </div>
                           <div class="list-group">
                              <a href="my-profile.php" class="list-group-item list-group-item-action"><i aria-hidden="true" class="mdi mdi-account-outline"></i>  My Profile</a>
                              <a href="Account-Settings.php" class="list-group-item list-group-item-action"><i aria-hidden="true" class="mdi mdi-account-settings-variant"></i>  Account Settings</a>
                             
                              <a href="orderlist.php" class="list-group-item list-group-item-action active"><i aria-hidden="true" class="mdi mdi-format-list-bulleted"></i>  My Orders</a> 
                              
                              <a href="returnList.php" class="list-group-item list-group-item-action"><i aria-hidden="true" class="mdi mdi-keyboard-return"></i> Return Orders</a> 
                              
                              <a onclick="myLogout()" href="#" class="list-group-item list-group-item-action"><i aria-hidden="true" class="mdi mdi-lock"></i>  Logout</a> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-8">
                        <div class="card card-body account-right">
                           <div class="widget">
                              <div class="section-header">
                                 <h5 class="heading-design-h5">
                                    My Orders
                                 </h5>
                              </div>
                              <div class="order-list-tabel-main table-responsive">
                                 <table id="orderTable" class="datatabel table table-striped table-bordered order-list-tabel" width="100%" cellspacing="0">
                                    <thead>
                                       <tr>
                                          <th>Order #</th>
                                          <th>Date Purchased</th>
                                          <th>Total</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        getAllOrders($cusId);
                                        ?>
                                       
                                       
                                      
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
        <div class="modal fade exampleModal" id="orderDetailsDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="order_details">
                                
                                            
                                           
                                         
                                            
                                        
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                            
                        </div>
                    </div>
                    
        <div class="modal fade exampleModal" id="orderReturnDetailsDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleReturnModalLabel">Return Order</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="order_return_details">
                                
                                              
                                        
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
      <!-- Data Tables -->
      <link href="vendor/datatables/datatables.min.css" rel="stylesheet" />
      <script src="vendor/datatables/datatables.min.js"></script>
      <script>
         $(document).ready(function() {
             $('.datatabel').DataTable({
                "ordering": false,
                 "bStateSave": true,
                    "fnStateSave": function (oSettings, oData) {
                        localStorage.setItem('offersDataTables', JSON.stringify(oData));
                    },
                    "fnStateLoad": function (oSettings) {
                        return JSON.parse(localStorage.getItem('offersDataTables'));
                    }
             });
         } );
      </script>
      
      <script>
         $(document).ready(function() {
             $('.datatabelOrderDetails').DataTable({
                 "dom": 'lrtip',
                 "bLengthChange": false,
                 "bInfo" : false,
                 "bPaginate": false
             });
         } );
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
      
      <script>  
     $(document).ready(function(){  
          $("#orderTable").on("click", ".btnViewOrder", function(){  
               var cart_id = $(this).attr("id");  
               $.ajax({  
                    url:"viewOrderDetails.php",  
                    method:"post",  
                    data:{cart_id:cart_id},  
                    success:function(data){  
                         $('#order_details').html(data);  
                         $('#orderDetailsDataModal').modal("show");  
                    }  
               });  
          });  
     });  
     </script>
     
     <script> 
         

     $(document).ready(function(){  
          $("#orderTable").on("click", ".btnReturn", function(){  
               var cart_id = $(this).attr('id'); 
               $.ajax({  
                    url:"orderReturnList.php",  
                    method:"post",  
                    data:{cart_id:cart_id},  
                    success:function(data){  
                       
                        
                         $('#order_return_details').html(data);  
                         $('#orderReturnDetailsDataModal').modal("show");  
                    }  
               });  
          });  
     });  
     </script>
     
     <script> 
         

     $(document).ready(function(){  
          $("#orderTable").on("click", ".btnCancelReturn", function(){  
               var order_id = $(this).attr('id'); 
               $.ajax({  
                    url:"cancalReturnOrders.php",  
                    method:"post",  
                    data:{order_id:order_id},  
                    success:function(data){  
                       if(data == "Return order has been canceled")
                         {
                             toastr.success(
                              '',
                              data,
                              {
                                timeOut: 1800,
                                fadeOut: 1800,
                                onHidden: function () {
                                    location.reload();
                                    //$("#orderTableArea").load(" #orderTableArea");
                                  }
                              }
                            );
                             
                         }
                        else{
                            toastr.error(
                              '',
                              data,
                              {
                                timeOut: 1800,
                                fadeOut: 1800,
                                onHidden: function () {
                                    location.reload();
                                    //$("#orderTableArea").load(" #orderTableArea");
                                  }
                              }
                            );
                        }
                    }  
               });  
          });  
     });  
     </script>
     
     
     
     <script> 
         

     $(document).ready(function(){  
          $("#orderReturnDetailsDataModal").on("click", ".btnReturnOrderNow", function(){
              $(this).attr( "disabled", "disabled" );
              var order_Id = $(this).attr("id");
              var productId = [];  
           $('.productID').each(function(){  
                if($(this).is(":checked"))  
                {  
                    
                     productId.push($(this).val());  
                }  
           });  
           productId = productId.toString();  
              if(productId == null || productId == "")
                  {
                      $(this).removeAttr( "disabled", "disabled" );
                      toastr.info(
                              '',
                              'Please select some items to return',
                              {
                                timeOut: 1800,
                                fadeOut: 1800,
                                onHidden: function () {
                                    //location.reload();
                                  }
                              }
                            );
                  }
              else{
           $.ajax({  
                url:"returnOrder.php",  
                method:"POST",  
                data:{productId:productId,order_Id:order_Id},  
                success:function(data){  
                     if(data == "Return order has been placed, Once Confirm our team member will contact you- Thankyou!")
                         {
                             toastr.success(
                              '',
                              data,
                              {
                                timeOut: 1800,
                                fadeOut: 1800,
                                onHidden: function () {
                                    location.reload();
                                    //$("#orderTableArea").load(" #orderTableArea");
                                  }
                              }
                            );
                             
                         }
                    else{
                        toastr.error(
                              '',
                              data,
                              {
                                timeOut: 1800,
                                fadeOut: 1800,
                                onHidden: function () {
                                    //location.reload();
                                  }
                              }
                            );
                    }
                    
                    
                    
                }  
           });
          }
              
              
          });  
     });  
     </script>
     
     
      
      <!-- Custom -->
      <script src="js/custom.js"></script>
      
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