<!doctype html>
<html lang="en">


<head>
        
        <meta charset="utf-8" />
        <title>Warnasisri FoodCity | Admin</title>
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
                                            <h5 class="text-primary">Welcome Back !</h5>
                                            <p>Sign in to continue to Warnasiri FoodCity.</p>
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
                                   <div id="error_message"></div>
                                    <form class="form-horizontal" method="post" action="assets/functions/functionLoginAdmin.php">
        
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" name="email" id="username" placeholder="Enter username">
                                        </div>
                
                                        <div class="form-group">
                                            <label for="userpassword">Password</label>
                                            <input type="password" class="form-control" name="password" id="userpassword" placeholder="Enter password">
                                        </div>
                
                                        
                                        
                                        <div class="mt-3">
                                            <button class="btn btn-primary btn-block waves-effect waves-light" name="btnLogin"  onclick = "return validate() " type="submit">Log In</button>
                                        </div>
            
                                        <div class="mt-4 text-center">
                                            <a href="auth-forgetpw.php" class="text-muted"><i class="mdi mdi-lock mr-1"></i> Forgot your password?</a>
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
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        
        <!-- App js -->
        <script src="assets/js/app.js"></script>
        
        
        
         
       <script type="text/javascript">
           
            function validate(){
                
            var email = document.getElementById("username").value;
                var pass = document.getElementById("userpassword").value;
                var error_message = document.getElementById("error_message");
                
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
             
              }
                
                
                
                if(pass == ""){
                text = "Please  Enter Your Password";
                   error_message.innerHTML = text;
                return false;
                 }
                
                
                 return true;
 
            }
           </script>
        
    </body>
     

</html>
