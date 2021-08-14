<!doctype html>
<html lang="en">

    

<head>
        
        <meta charset="utf-8" />
        <title>Warnasiri FoodCity | Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
         <link href="assets/css/styles.css" rel="stylesheet" type="text/css" /> 
        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
         <link href=" https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />

    </head>

    <body>
       
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-soft-primary">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary"> Forget Password</h5>
                                            <p>Re-Password with Daya Stoers.</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0"> 
                                <div>
                                
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="assets/images/logo.svg" alt="" class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                   
                                </div>
                                
                                <div class="p-2">
                                    <div class="alert alert-success text-center mb-4" role="alert">
                                        Enter your Email and Verify Code will be sent to you!
                                    </div>
                                    
                                         
                                    <form class="form-horizontal" >
            
                                        <div class="form-group">
                                            <label for="useremail">Email</label>
                                            <input type="email" class="form-control" id="useremail" placeholder="Enter email">
                                            </div>
                                             <div class="col-12 text-right">
                                            <button class="btn btn-primary w-md waves-effect waves-dark btnSendVerification" type="button">Send Verification</button>
                                            </div>
                                            
                                        
                                         <div class="form-group">
                                            <label for="userverify">Verify Code</label>
                                            <input type="password" class="form-control" id="Verifycode" >
                                        </div>
                                        
                                         <div class="form-group">
                                            <label for="userchangepass">New Password</label>
                                            <input type="password" class="form-control" id="Newpass" >
                                        </div>
                                        <div class="form-group">
                                            <label for="confpass">Confirm Password</label>
                                            <input type="password" class="form-control" id="Confpass" >
                                        </div>
                    
                                        <div class="form-group row mb-0">
                                            <div class="col-12 text-right">
                                                <button class="btn btn-primary w-md waves-effect waves-light btnChangePassword" type="button">Reset Password</button>
                                            </div>
                                        </div>
    
                                    </form>
                                </div>
            
                            </div>
                        </div>
                     

                    </div>
                </div>
            </div>
        </div>

        <!-- JAVASCRIPT -->
        <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        
        <!-- App js -->
        <script src="assets/js/app.js"></script>
        
        
        

        
        
        <script>  
     $(document).ready(function(){  
        var varificationCode = "";
         var cusEmail = "";
          $(".btnSendVerification").click(function () {
              
              var email = document.getElementById("useremail").value;
              
              
                 if(email.indexOf("@") == -1 || email.length < 6){
                  
                  toastr.error(
                              '',
                              'Please Enter valid Email',
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
                              'Please re-check your email address',
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
                              'Please re-check your email address correctly',
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
                    url:"foegtPassEmail.php",  
                    method:"post",  
                    data:{
                       emailAdd:email
                    },  
                    success:function(data){ 
                        
                        if(data == "Please make sure the entered email address is correct")
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
                        else if(data == "Something went wrong please try again!"){
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
                        else{
                            cusEmail = email;
                            varificationCode = data;
                            toastr.success(
                              '',
                             'We have sent you an verification code - Thankyou!',
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
         $(".btnChangePassword").click(function () {
             
               var verifycode = document.getElementById("Verifycode").value;
               var pass = document.getElementById("Newpass").value;
               var pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
               var conpass=document.getElementById("Confpass").value;
             if(cusEmail == "")
                 {
                     toastr.error(
                      '',
                     'Please Enter Your Email Address',
                      {
                        timeOut: 800,
                        fadeOut: 800,
                        onHidden: function () {

                          }
                      }
                    );
                 }
             else if(varificationCode == "")
                 {
                    toastr.error(
                      '',
                     'Please Enter Your Email Address',
                      {
                        timeOut: 800,
                        fadeOut: 800,
                        onHidden: function () {

                          }
                      }
                    ); 
                 }
           
            else if(verifycode == ""){
                
                   toastr.error(
                      '',
                     'Please Enter Verify Code',
                      {
                        timeOut: 800,
                        fadeOut: 800,
                        onHidden: function () {

                          }
                      }
                    );
                 }
            else if(isNaN(verifycode)    ){
               
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
          
           
             else if(pass ==""){
                
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
                else if(pass.length>20){
                
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
               else if(conpass ==""){
                
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
                
                 else if(pass != conpass){
                
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
                 else if(verifycode == varificationCode){
                    $.ajax({  
                    url:"forgetPwResetPass.php",  
                    method:"post",  
                    data:{
                        pass:pass,
                        cusEmail:cusEmail
                    },  
                    success:function(data){ 
                        
                        if(data == "Passsword has been updated")
                            {
                               toastr.success(
                                  '',
                                 data,
                                  {
                                    timeOut: 800,
                                    fadeOut: 800,
                                    onHidden: function () {
                                        
                                        window.location.replace("index.php");
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
                else
                    {
                        toastr.error(
                      '',
                     'Please enter the correct verification code',
                      {
                        timeOut: 800,
                        fadeOut: 800,
                        onHidden: function () {

                          }
                      }
                    );
                    }
             
         });
        
     });  
     </script>
        
        
        
        
        
    </body>


</html>
