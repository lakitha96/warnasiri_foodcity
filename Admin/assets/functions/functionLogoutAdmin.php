<?php
session_start();
session_destroy();

 
  echo "
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'</script>
         <script src='ttps://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js'</script>
    <script>  
     $(document).ready(function(){
     
     toastr.success(
                              '',
                              'Succesfully Logout',
                              {
                              positionClass: 'toast-top-center',
                                timeOut: 1000,
                                fadeOut: 1000,
                                onHidden: function () {
                                   window.location.replace('../../Index.php');
                                  }
                                  
                              }
                            );
                            
     
     });
                    
                    </script>
    ";
    



?>
<html>
    <head>
         <link href=" https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
         <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    </head>
</html>