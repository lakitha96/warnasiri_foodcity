<?php
session_start();
if(!isset($_SESSION['adminUsername']))
{
    
}
else
{
   include("assets/functions/function.php");
    include("assets/functions/db.php");
 if(isset($_POST["curntPassword"]) && isset($_POST["newphone"]))  
 {
     
     $currentPass = $_POST["curntPassword"];
     $newContactNo = $_POST["newphone"];
     $adminEmail = $_SESSION['adminUsername'];
     $getCurrentPass = "SELECT `admin_password`,`admin_number` FROM `tbl_admin` WHERE `admin_email` = '$adminEmail'";
     $currentPassDetails = mysqli_fetch_assoc(mysqli_query($db,$getCurrentPass));
     $adminPass = $currentPassDetails['admin_password'];
     $adminContact = $currentPassDetails['admin_number'];
     if($currentPass != $adminPass)
     {
         echo "Please re-check your current password";
     }
     else
     {
     if($adminContact == $newContactNo)
     {
         echo "Please enter new contact number rather than old contact number";
     }
     else
     {
         $updatePassword = "UPDATE `tbl_admin` SET `admin_number`='$newContactNo' WHERE `admin_email` = '$adminEmail'";
         if(mysqli_query($db,$updatePassword) == 1)
         {
             echo "Conatact Number have been updated";
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