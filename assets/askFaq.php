<?php


session_start();

include("db.php");

if(isset($_POST['btnSendFaq']))
{
$page = $_SESSION['atPage'];

  $name = $_POST['name'];
$emailAdd =  $_POST['emailAddress'];
$contactNo =  $_POST['phoneNo'];
$message =  $_POST['cusMsg'];
    
    
    $insertIntoFaq = "INSERT INTO `tbl_faq_customer`( `cus_name`, `cus_email`, `cus_phone`, `cus_message`) VALUES ('$name','$emailAdd','$contactNo','$message')";
    $insertRes = mysqli_query($con,$insertIntoFaq);
    if($insertRes == 1)
    {
        echo "
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'</script>
         <script src='ttps://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js'</script>
    <script>  
     $(document).ready(function(){
     
     toastr.success(
                              '',
                              'Successfully submitted your FAQ',
                              {
                              
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
    else
    {
        echo "
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'</script>
         <script src='ttps://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js'</script>
    <script>  
     $(document).ready(function(){
     
     toastr.info(
                              '',
                              'Error occured while submitting FAQ - Please try Again',
                              {
                              
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