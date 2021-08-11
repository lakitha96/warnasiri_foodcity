<?php
session_start();
include("assets/functions/function.php");
include("assets/functions/db.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require 'vendor/autoload.php';
if(isset($_SESSION['adminUsername']))
{
    
}
else
{
    
    if(isset($_POST['cusEmail']))
    {
        $email = $_POST['cusEmail'];
        $pass = $_POST['pass'];
        $updatePassword = "UPDATE `tbl_admin` SET `admin_password`='$pass' WHERE `admin_email` = '$email'";
        if(mysqli_query($db,$updatePassword) == 1)
        {
            $_SESSION['adminUsername'] = $email;
            echo "Passsword has been updated";
            
        }
        else
        {
            echo "Something went wrong please try again";
        }
    }
    else
    {
        echo "Something went wrong please try again";
    }
}
?>