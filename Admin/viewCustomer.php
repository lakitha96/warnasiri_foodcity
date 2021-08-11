<?php  
session_start();
if(!isset($_SESSION['adminUsername']))
{
     echo "
                    <script>
                        function goBack(){
                            alert('Please Login!');
                          window.location.replace('auth-login.php');
                        }
                        
                        goBack();
                    </script>
    ";
}
else
{
include("assets/functions/function.php");
include("assets/functions/db.php");
 if(isset($_POST["customer_id"]))  
 {
      $cus_ID = $_POST["customer_id"];
     
    
     
     $selectCustomerDetailsQuery = "SELECT * FROM `tbl_customer` where cus_id = '$cus_ID' ";
    $customerDetailResult = mysqli_query($con,$selectCustomerDetailsQuery);
     while($customerDetails=mysqli_fetch_array($customerDetailResult))
     {
        
      
         $cusID = $customerDetails['cus_id'];
         $cusFirstName = $customerDetails['cus_fname'];
         $cusLastName = $customerDetails['cus_lname'];
         $cusPhone = $customerDetails['cus_tele'];
         $cusNICNo = $customerDetails['cus_nic'];
         $cusCity = $customerDetails['cus_city'];
         $cusEmailAddress = $customerDetails['cus_email'];
         $cusImage = $customerDetails['cus_image'];
         $cusAddress = $customerDetails['cus_address'];
         
         if($cusImage == null || $cusImage == "")
         {
             $cusImage ="commonuser.jpg";
         }
         if($cusFirstName == null || $cusFirstName == "")
         {
             $cusFirstName = "N/A";
         }
         if($cusLastName == null || $cusLastName == "")
         {
             $cusLastName = "N/A";
         }
         if($cusPhone == null || $cusPhone == "")
         {
             $cusPhone = "N/A";
         }
         if($cusNICNo == null || $cusNICNo == "")
         {
             $cusNICNo = "N/A";
         }
         if($cusCity == null || $cusCity == "")
         {
             $cusCity = "N/A";
         }
         if($cusAddress == null || $cusAddress == "")
         {
             $cusAddress = "N/A";
         }
         
     
     echo "
     
                <img class='productImageDetails' src='../img/user/$cusImage' />
               <br>
                <p class='mb-2'>Customer ID: <span class='text-primary'>$cusID</span></p>
                <p class='mb-2'>First Name: <span class='text-primary'>$cusFirstName</span></p>
                <p class='mb-2'>Last Name: <span class='text-primary'>$cusLastName</span></p>
                <p class='mb-2'>Contact No.: <span class='text-primary'>$cusPhone</span></p>
                <p class='mb-2'>National ID No.: <span class='text-primary'>$cusNICNo</span></p>
                <p class='mb-2'>City: <span class='text-primary'>$cusCity</span></p>
                <p class='mb-2'>Email Address: <span class='text-primary'>$cusEmailAddress</span></p>
                <p class='mb-2'>Customer Address: <span class='text-primary'>$cusAddress</span></p>
     ";
     
     
         
         
     }
     
 }
}
?>
     
     