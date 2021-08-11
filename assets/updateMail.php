<?php
session_start();
include("db.php");


$page = $_SESSION['atPage'];
 
if(isset($_POST['btnChangeEmail']))
{

    $oldEmail = $_SESSION['cusEmailaddress'];
    $password = $_SESSION['cusPassword'];


$newEmail=$_POST['newCusEmail'];

$query = "UPDATE `tbl_customer` SET `cus_email`='$newEmail' WHERE cus_email='$oldEmail' and cus_password = '$password'";
$result = mysqli_query($con,$query);

 if($result==1)
    {
     $_SESSION['cusEmailaddress'] = $newEmail;
      
     
      echo "
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'</script>
         <script src='ttps://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js'</script>
    <script>  
     $(document).ready(function(){
     
     toastr.success(
                              '',
                              'Your Account Email address been updated - Thankyou!',
                              {
                              positionClass: 'toast-top-center',
                                timeOut: 1000,
                                fadeOut: 1000,
                                onHidden: function () {
                                   window.location.replace('../$page');
                                  }
                                  
                              }
                            );
                            
     
     });
                    
                    </script>
    ";
     
     
     
        
        
    }
    else{
       
        
         echo "
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'</script>
         <script src='ttps://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js'</script>
    <script>  
     $(document).ready(function(){
     
     toastr.error(
                              '',
                              'Update Email cannot be done due to error - Please Try Again!',
                              {
                              positionClass: 'toast-top-center',
                                timeOut: 1000,
                                fadeOut: 1000,
                                onHidden: function () {
                                   window.location.replace('../$page');
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