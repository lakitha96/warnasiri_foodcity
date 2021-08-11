<?php



include("assets/functions/function.php");
include("assets/functions/db.php");
    


session_start();
$_SESSION['atAdminPage']="myprofile.php";
if(!isset($_SESSION['adminUsername']))
{
     echo "
                    <script>
                        function goBack(){
                            
                          window.location.replace('auth-login.php');
                        }
                        
                        goBack();
                    </script>
    ";
}
else
{

?>
<!DOCTYPE html>
   

   
    

    
    <html lang="en">

    

<head>
        
        <meta charset="utf-8" />
        <title>දයා Stores | Admin </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
           <link href="assets/css/styles.css" rel="stylesheet" type="text/css" /> 
        <!-- select2 css -->
        <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

        <!-- dropzone css -->
        <link href="assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/dropzone/min/dropify.min.css" rel="stylesheet" type="text/css" />


        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
         <link href=" https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />

    </head>

    <body data-sidebar="dark">

        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <?php include("assets/includes/topheader.php"); ?>
            </header> <!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <?php include("assets/includes/slidebar.php"); ?>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                      <div class="p-2">
                                      
                                    <form class="form-horizontal" >
                                         <h5 class="heading-design-h5">
                                    Change Phone Number
                                       </h5><br>
                                         <div class="form-group">
                                            <label for="currenumber">Admin Password</label>
                                            <input type="text" class="form-control" id="currentPassword" placeholder="Enter Current Number">
                                            </div>
                                             <div class="form-group">
                                            <label for="newnumber">New Phone Number</label>
                                            <input type="text" class="form-control" id="newnum" placeholder="Enter New Number">
                                            </div>
                                            
                                             
                                            
                                            
                                             <div class="col-12 text-right">
                                            <button class="btn btn-primary w-md waves-effect waves-dark btnUpdateMobNumber" type="button">Update Contact Number </button>
                                            </div>
                                            <div class="diff" >
                                           <span> OR</span>
                                          </div>
                                             <h5 class="heading-design-h5">
                                           Change Email Address
                                       </h5><br>
                                        <!--
                                         <div class="form-group">
                                            <label for="currentemail">Current Email</label>
                                            <input type="email" class="form-control" id="cemail" placeholder="Enter Current Email">
                                        </div>
                                       -->
                                         <div class="form-group">
                                            <label for="useremail">  NEW Email</label>
                                            <input type="email" class="form-control" id="newemail" placeholder="Enter  New Email">        
                                        </div>
                
                                           <div class=" text-right">
                                            <button class="btn btn-primary w-md waves-effect waves-dark getVerificationEmail" type="button">Get Verifycation Code</button>
                                            
                                            <button hidden class="btn btn-warning w-md waves-effect waves-dark btnChangeEmail" type="button">Change Email</button>
                                            </div>
                                            
                                             <div class="form-group">
                                            <label for="otpcode">Verifycation Code</label>
                                            <input type="text" class="form-control" id="code" placeholder="Enter  Code">
                                        </div>
                                            <div class="col-12 text-right">
                                            <button class="btn btn-primary w-md waves-effect waves-dark btnUpdateEmailAddress" type="button">Update Email </button>
                                            </div>
                                        
                                         <div class="diff" >
                                           <span> OR</span>
                                          </div>
                                           <h5 class="heading-design-h5">
                                           Change Password
                                       </h5><br>
                                        
                                         <div class="form-group">
                                            <label for="curpass">Current Password</label>
                                            <input type="password" class="form-control" id="curpass" placeholder="Enter Current Password ">
                                        </div>
                                        <div class="form-group">
                                            <label for="newpass">New Password</label>
                                            <input type="password" class="form-control" id="newpass" placeholder="Enter New Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="conpass">Confirm Password</label>
                                            <input type="password" class="form-control" id="conpass" placeholder="Confirm Password">
                                        </div>
                                        
                                       
                    
                                     <div class="col-12 text-right">
                                            <button class="btn btn-primary w-md waves-effect waves-dark resetPassword" id="btn" type="button">Reset Password</button>
                                        </div>
                
                                       
                                    </form>
                                </div>
                        
                        
                        
                        
                        
                   
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
              
            </div>
          

        </div>
        

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <script src="assets/js/app.js"></script>
        
        
 
         <script>  
     $(document).ready(function(){  
          $(".btnUpdateMobNumber").click(function () {
              
           var curntPassword = document.getElementById("currentPassword").value;
                  var newphone = document.getElementById("newnum").value;
              
              
                if(curntPassword==""){
               
                   toastr.error(
                      '',
                      'Enter Your Current Phone Number',
                      {
                        timeOut: 800,
                        fadeOut: 800,
                        onHidden: function () {

                          }
                      }
                    );
                 }
                
                 else if(newphone==""){
                
                   toastr.error(
                      '',
                      'Enter Your  New Phone Number',
                      {
                        timeOut: 800,
                        fadeOut: 800,
                        onHidden: function () {

                          }
                      }
                    );
                 }
                   
                else if(isNaN(newphone)    ){
                
                  toastr.error(
                      '',
                      'Numbers Only Allow For Phone Number',
                      {
                        timeOut: 800,
                        fadeOut: 800,
                        onHidden: function () {

                          }
                      }
                    );
                 }
                else if( newphone.length !=11){
             
                   toastr.error(
                      '',
                      'Please Cheak Again New Phone Number Correctly',
                      {
                        timeOut: 800,
                        fadeOut: 800,
                        onHidden: function () {

                          }
                      }
                    );
                 }
              
              
             
              else
              {
                  $.ajax({  
                    url:"changeAdminContactNo.php",  
                    method:"post",  
                    data:{
                        curntPassword : curntPassword,
                        newphone : newphone
                    },  
                    success:function(data){  
                        if(data == "Conatact Number have been updated")
                            {
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
                        else if(data == "Please enter new contact number rather than old contact number")
                            {
                                toastr.info(
                              '',
                              data,
                              {
                                timeOut: 800,
                                fadeOut: 800,
                                onHidden: function () {
                                   
                                  }
                              }
                            );
                            }
                        else{
                            toastr.error(
                              '',
                              data,
                              {
                                timeOut: 800,
                                fadeOut: 800,
                                onHidden: function () {
                                    
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
        
        
        
        
        
        
        <script>  
     $(document).ready(function(){  
         var sentCode = "";
         var newEmail = "";
          $(".getVerificationEmail").click(function () {
              var email = document.getElementById("newemail").value;
              
              if(email.indexOf("@") == -1 || email.length < 6){
                   
                      toastr.error(
                      '',
                      'Please Enter New Valid Email',
                      {
                        timeOut: 800,
                        fadeOut: 800,
                        onHidden: function () {

                          }
                      }
                    );
                 }
                
            
              else if((email.charAt(email.length-4)!='.')&& (email.charAt(email.length-3)!='.'))
              {
                 
                  toastr.error(
                      '',
                      'Please Re-check your email address',
                      {
                        timeOut: 800,
                        fadeOut: 800,
                        onHidden: function () {

                          }
                      }
                    );
             
              }
              
               else if(email.length>50)
              {
                 
                  toastr.error(
                      '',
                      'Please Re-check your email address',
                      {
                        timeOut: 800,
                        fadeOut: 800,
                        onHidden: function () {

                          }
                      }
                    );
             
              }
              
              
              else{
                  
                  
                  
                  
                  $.ajax({  
                    url:"updateEmailAddress.php",  
                    method:"post",  
                    data:{
                        email:email
                    },  
                    success:function(data){  
                        
                        if(data == "Please enter new email rather than old email")
                        {
                               toastr.info(
                              '',
                              data,
                              {
                                timeOut: 800,
                                fadeOut: 800,
                                onHidden: function () {
                                    
                                  }
                              }
                            ); 
                            
                        }
                        else if(data != "")
                        {
                            newEmail = email;
                            sentCode = data;
                            toastr.info(
                              '',
                              'Please verify the verification code we sent into your new mail',
                              {
                                timeOut: 800,
                                fadeOut: 800,
                                onHidden: function () {
                                    
                                  }
                              }
                            ); 
                            $("#newemail").attr( "disabled", "disabled" );
                            $(".getVerificationEmail").attr( "disabled", "disabled" );
                            $(".btnChangeEmail").removeAttr( "hidden", "hidden" );
                        }
                        else{
                            
                            toastr.info(
                              '',
                              'Something went wrong - Try again later',
                              {
                                timeOut: 800,
                                fadeOut: 800,
                                onHidden: function () {
                                    
                                  }
                              }
                            );
                        }
                        
                        
                        
                          
                    }  
               });
                  
                  
              }
                 
                 
          });  
         $(".btnUpdateEmailAddress").click(function () { 
               var verifycode = document.getElementById("code").value;
             if(sentCode == "")
             {
                 toastr.error(
                  '',
                  'Please enter your new email',
                  {
                    timeOut: 800,
                    fadeOut: 800,
                    onHidden: function () {
                      
                      }
                  }
                );
             }
             else if(verifycode == "")
             {
                
                    toastr.error(
                  '',
                  'Please Enter Your Code',
                  {
                    timeOut: 800,
                    fadeOut: 800,
                    onHidden: function () {
                      
                      }
                  }
                );
            }
           else if(isNaN(verifycode))
           {
              
                    toastr.error(
                  '',
                  'Only  Numbers Are Allowed',
                  {
                    timeOut: 800,
                    fadeOut: 800,
                    onHidden: function () {
                      
                      }
                  }
                );
               
               
            }
             else if(verifycode == sentCode)
            {
                
                     $.ajax({  
                    url:"updateNewEmail.php",  
                    method:"post",  
                    data:{
                        newEmail:newEmail
                    },  
                    success:function(data){ 
                        
                        if(data == "New email address have been saved")
                            {
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
                        else{
                            toastr.error(
                              '',
                             data,
                              {
                                timeOut: 800,
                                fadeOut: 800,
                                onHidden: function () {

                                  }
                              }
                            );
                        }
                        
                    }
                    });
                     
                 }
             else{
                  toastr.error(
                              '',
                             'PLease enter the correct verification code',
                              {
                                timeOut: 800,
                                fadeOut: 800,
                                onHidden: function () {

                                  }
                              }
                            );
             }
            
              
          });
         
          $(".btnChangeEmail").click(function () { 
               $("#newemail").removeAttr( "disabled", "disabled" );
                $(".getVerificationEmail").removeAttr( "disabled", "disabled" );
              sentCode="";
              
          });
         
         
         
     });  
     </script>
        
        
        
         <script>  
     $(document).ready(function(){  
          $(".resetPassword").click(function () {
              
            var pass = document.getElementById("newpass").value;
            var conpass=document.getElementById("conpass").value;
            var pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
            var txtCurrentPass=document.getElementById("curpass").value;
              
              if(txtCurrentPass == "")
              {
                toastr.error(
                  '',
                  'Please  Enter Your Current Password',
                  {
                    timeOut: 800,
                    fadeOut: 800,
                    onHidden: function () {
                      
                      }
                  }
                );
              }
              else if(pass =="")
              {
                 toastr.error(
                  '',
                  'Please  Enter Your Password',
                  {
                    timeOut: 800,
                    fadeOut: 800,
                    onHidden: function () {
                      
                      }
                  }
                ); 
              }
              else if(!(pass.match(pattern))){
                
                    toastr.error(
                      '',
                     'New password should between 6 to 20 characters which contain at least one numeric digit, one uppercase and one lowercase letter',
                      {
                        timeOut: 800,
                        fadeOut: 800,
                        onHidden: function () {

                          }
                      }
                    );
                 }
               else if(pass.length>20)
              {
                 toastr.error(
                  '',
                  'Please  Enter Your Password Between 1-20',
                  {
                    timeOut: 800,
                    fadeOut: 800,
                    onHidden: function () {
                      
                      }
                  }
                ); 
              }
              
              
              else if(conpass =="")
              {
                  toastr.error(
                  '',
                  'Please  Enter Your Confirm Password',
                  {
                    timeOut: 800,
                    fadeOut: 800,
                    onHidden: function () {

                      }
                  }
                ); 
              }
              else if(!(conpass.match(pattern))){
                
                    toastr.error(
                      '',
                     'Confirm password should between 6 to 20 characters which contain at least one numeric digit, one uppercase and one lowercase letter',
                      {
                        timeOut: 800,
                        fadeOut: 800,
                        onHidden: function () {

                          }
                      }
                    );
                 }
              else if(pass !=conpass)
              {
                      toastr.error(
                  '',
                  'Password not matching',
                  {
                    timeOut: 800,
                    fadeOut: 800,
                    onHidden: function () {
                        
                      }
                  }
                );  
              }
              else
              {
                  $.ajax({  
                    url:"changeAdminPass.php",  
                    method:"post",  
                    data:{
                        pass : pass,
                        conpass : conpass,
                        txtCurrentPass : txtCurrentPass
                    },  
                    success:function(data){  
                        if(data == "Password have been updated")
                            {
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
                        else if(data == "Please enter new password rather than old password")
                            {
                                toastr.info(
                              '',
                              data,
                              {
                                timeOut: 800,
                                fadeOut: 800,
                                onHidden: function () {
                                   
                                  }
                              }
                            );
                            }
                        else{
                            toastr.error(
                              '',
                              data,
                              {
                                timeOut: 800,
                                fadeOut: 800,
                                onHidden: function () {
                                    
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
        
        
        
        
        

    </body>


</html>
<?php } ?>