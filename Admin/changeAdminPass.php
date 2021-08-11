<?php
session_start();
if(!isset($_SESSION['adminUsername']))
{
    
}
else
{
   include("assets/functions/function.php");
    include("assets/functions/db.php");
 if(isset($_POST["pass"]) && isset($_POST["conpass"]) && isset($_POST["txtCurrentPass"]))  
 {
     $newPass = $_POST["pass"];
     $currentPass = $_POST["txtCurrentPass"];
     $adminEmail = $_SESSION['adminUsername'];
     $getCurrentPass = "SELECT `admin_password` FROM `tbl_admin` WHERE `admin_email` = '$adminEmail'";
     $currentPassDetails = mysqli_fetch_assoc(mysqli_query($db,$getCurrentPass));
     $adminPass = $currentPassDetails['admin_password'];
     if($currentPass != $adminPass)
     {
         echo "Please re-check your current password";
     }
     else
     {
     if($adminPass == $newPass)
     {
         echo "Please enter new password rather than old password";
     }
     else
     {
         $updatePassword = "UPDATE `tbl_admin` SET `admin_password`='$newPass' WHERE `admin_email` = '$adminEmail'";
         if(mysqli_query($db,$updatePassword) == 1)
         {
             echo "Password have been updated";
         }
         else
         {
             echo "Something went wrong please try again!";
         }
     }
     }
 } 
}

?>