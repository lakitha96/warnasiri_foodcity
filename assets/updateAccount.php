<?php

session_start();
include("db.php");


$page = $_SESSION['atPage'];
if(isset($_POST['btnSave']))
{
$userEmail = $_SESSION['cusEmailaddress'];
$userPassword = $_SESSION['cusPassword'];
    $userID = $_SESSION['customerId'];
$userImage = $_FILES['userUploadimage']['name'];
$userImg_name = $_FILES['userUploadimage']['tmp_name'];
    
    if($userImage==null || $userImage=="")
    {
        $selectOld = "select * from tbl_customer where cus_email='$userEmail' and cus_password = '$userPassword'";
        $result = mysqli_query($con,$selectOld);
        $getDetails = mysqli_fetch_array($result);
        $userImage = $getDetails['cus_image'];
    }
    else
    {
         move_uploaded_file($userImg_name,"../img/user/$userID$userImage");
        $userImage = "$userID$userImage";
    }

$userFName =  $_POST['fname'];
$userLName =  $_POST['lname'];
$userPhone =  $_POST['contactno'];
$userNIC   =  $_POST['nicNo'];
$userCity  =  $_POST['userCity'];
$userAddress =  $_POST['addressAres'];
    

    


$query = "UPDATE `tbl_customer` SET `cus_fname`='$userFName',`cus_lname`='$userLName',`cus_tele`='$userPhone',`cus_nic`='$userNIC',`cus_city`='$userCity',`cus_address`='$userAddress',`cus_image`='$userImage' WHERE cus_email='$userEmail' and cus_password = '$userPassword'";

    

$result = mysqli_query($con,$query);

 if($result==1)
    {
      
     
     echo "
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'</script>
         <script src='ttps://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js'</script>
    <script>  
     $(document).ready(function(){
     
     toastr.success(
                              '',
                              'Your Account has been updated',
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
                              'Account cannot be updated due to error',
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