<?php
session_start();
include("assets/functions/function.php");
include("assets/functions/db.php");

if(!isset($_SESSION['adminUsername']))
{
    
}
else
{
    
    if(isset($_POST['newEmail']))
    {
        $adminEmail = $_SESSION['adminUsername'];
        $newEmail = $_POST['newEmail'];
        $updateEmailAddress = "UPDATE `tbl_admin` SET `admin_email`= '$newEmail' WHERE `admin_email` = '$adminEmail'";
        if(mysqli_query($db,$updateEmailAddress) == 1)
        {
            $_SESSION['adminUsername'] = $newEmail;
            echo "New email address have been saved";

        }
        else
        {
            echo "Something went wrong please try again";
        }
    
    }
}
?>