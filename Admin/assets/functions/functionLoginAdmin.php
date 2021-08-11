<?php
session_start();

include("db.php");

if(isset($_POST['btnLogin']))
{


    $email=$_POST['email'];
    $pass=$_POST['password'];
    //$adminPage = $_SESSION['atAdminPage'];
    
    $checkAdminDetails = "SELECT admin_id FROM `tbl_admin` WHERE admin_email='$email' and admin_password='$pass'";
    $adminResults = mysqli_query($con,$checkAdminDetails);
    $adminInfo = mysqli_fetch_assoc($adminResults);
    $adminId = $adminInfo['admin_id'];
    
    if($adminId == null || $adminId == "")
    {
        
        echo "
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'</script>
         <script src='ttps://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js'</script>
    <script>  
     $(document).ready(function(){
     
     toastr.error(
                              '',
                              'Make sure entered details are correct.',
                              {
                              positionClass: 'toast-top-center',
                                timeOut: 1000,
                                fadeOut: 1000,
                                onHidden: function () {
                                    window.location.replace('../../auth-login.php');
                                  }
                                  
                              }
                            );
                            
     
     });
                    
                    </script>
    ";
        
    }
    else
    {
        $_SESSION['adminUsername'] = $email;
        $_SESSION['adminPassword'] = $pass;
        $_SESSION['adminId'] = $adminId;
        echo "
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'</script>
         <script src='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js'</script>
    <script>  
     $(document).ready(function(){
     
     toastr.success(
                              '',
                              'Successfully Logged',
                              {
                              positionClass: 'toast-top-center',
                                timeOut: 1000,
                                fadeOut: 1000,
                                onHidden: function () {
                                    window.location.replace('../../index.php');
                                  }
                                  
                              }
                            );
                            
     
     });
                    
                    </script>
    ";
    }
    
    
}


?>
<html>
    <head>
         <link href=" https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
         <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    </head>
</html>